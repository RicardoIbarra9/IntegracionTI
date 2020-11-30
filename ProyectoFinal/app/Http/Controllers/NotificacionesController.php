<?php

namespace App\Http\Controllers;

use App\Notificaciones;
use App\RelacionesUsuariosExternosConPacientes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //pendiente por extraer el id del usuario logeado
        $id = Auth::guard('usuario_externo')->id();

        $relaciones = RelacionesUsuariosExternosConPacientes::where('id_usuario_externo', $id)
            ->get();

        $idsPacientes = new Collection();

        foreach ($relaciones as $relacion) {
            $idsPacientes->push($relacion->id_paciente);
        }

        $notificaciones = Notificaciones::whereIn('id_paciente', $idsPacientes->toArray())
            ->get()
            ->sortByDESC('fecha');

//        $notificaciones = Notificaciones::all()
//            ->sortByDesc('fecha');

        return view('usuario_externo.inicio', array('notificaciones' => $notificaciones));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $id_paciente
     * @param $id_usuario_interno
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_paciente' => 'required',
            'id_usuario_interno' => 'required',
            'titulo' => 'required',
            'detalle' => 'required',
            'fecha' => 'required',
        ]);

        Notificaciones::create($request->all());

        return redirect()->route('inicio_usuario_interno')->with('success','Notificación creada.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Display the specified resource.
     */
    public function show($id)
    {
        $notificacion = Notificaciones::find($id);
        $this->marcarUnaNotificacionVista($id);
        return view('usuario_externo.ver_notificacion', array('notificacion' => $notificacion));
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $notificacion = Notificaciones::find($id);

        return view('usuario_interno.actualizar_notificacion', array('notificacion' => $notificacion));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     */

    public function update(Request $request, $id)
    {
        $notificacion = Notificaciones::find($id);
        $idUsuarioInterno = Auth::user()->id;
        //Si el usuario interno que quiere actualizar la notificacion pero no es el que la creo manda un mensaje que no puede acutalizarla
        if (!($notificacion->id_usuario_interno == $idUsuarioInterno))
        {
            return redirect()->route('ver_notificaciones_paciente', $request->get('id_paciente'))
                ->with('warning','No puedes actualizar la notificación.');
        }
        $request->validate([
            'id_paciente' => 'required',
            'id_usuario_interno' => 'required',
            'titulo' => 'required',
            'detalle' => 'required',
            'fecha' => 'required',
        ]);

        $notificacion->visto = false;
        $notificacion->update($request->all());
        $notificacion->save();

        return redirect()->route('ver_notificaciones_paciente', $request->get('id_paciente'))
            ->with('success','Notificación actualizada.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Notificaciones::find($id)
            ->delete();

        return redirect()
            ->back()
            ->with("success","Notificación borrada.");
    }

    /**
     * Marcar como leidas todas las notificaciones del usuario
     */
    public function marcarComoLeidos()
    {
        //pendiente por extraer el id del usuario logeado
        $notificaciones = Notificaciones::where('visto', false)->get();
        foreach ($notificaciones as $notificacion)
        {
            $notificacion->visto = true;
            $notificacion->save();
        }
        return redirect()
            ->back()
            ->with("succes","Notificaciones vistas.");
    }

    /**
     * Marca una notificacion vista
     * @param $id
     */
    public function marcarUnaNotificacionVista($id)
    {
        $notificacion = Notificaciones::find($id);
        $notificacion->visto = true;
        $notificacion->save();
    }
}
