<?php

namespace App\Http\Controllers;

use App\Pacientes;
use App\RelacionesUsuariosExternosConPacientes;
use App\UsuariosExternos;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RelacionesUsuariosExternosConPacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $relaciones = RelacionesUsuariosExternosConPacientes::all()
            ->sortBy('id_paciente');
        return view('usuario_interno.asignaciones', array('relaciones' => $relaciones));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $usuariosExternos = UsuariosExternos::all()
            ->sortBy('nombre');

        return view('usuario_interno.asignacion', array('usuariosExternos' => $usuariosExternos));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario_externo' => 'required',
            'id_paciente' => 'required',
            'parentesco' => 'required',
        ]);

        RelacionesUsuariosExternosConPacientes::create($request->all());

        return redirect()->route('ver_asignaciones')
            ->with('success','Asignación creada.');
    }

    /**
     * Display the specified resource.
     * @param RelacionesUsuariosExternosConPacientes $relacionesUsuariosExternosConPacientes
     */
    public function show(RelacionesUsuariosExternosConPacientes $relacionesUsuariosExternosConPacientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param RelacionesUsuariosExternosConPacientes $relacionesUsuariosExternosConPacientes
     */
    public function edit(RelacionesUsuariosExternosConPacientes $relacionesUsuariosExternosConPacientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param RelacionesUsuariosExternosConPacientes $relacionesUsuariosExternosConPacientes
     */
    public function update(Request $request, RelacionesUsuariosExternosConPacientes $relacionesUsuariosExternosConPacientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     */
    public function destroy($id)
    {
        RelacionesUsuariosExternosConPacientes::find($id)
            ->delete();

        return redirect()
            ->route('ver_asignaciones')
            ->with("success","Asignación borrada.");
    }

    /**
     * Buscar el nombre completo del paciente por nombre o fecha de ingreso
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function buscarPacientePorNombreFecha(Request $request)
    {
        $nombre_paciente = $request->get('buscar_nombre_paciente');
        $fecha_ingreso = CarbonImmutable::make($request->get('fecha_ingreso'));

        //Si la fecha es verdadera y nombre es falso
        if ($fecha_ingreso && !$nombre_paciente)
        {
            $pacientes = Pacientes::where('fecha_ingreso', '>=', $fecha_ingreso)
                ->where('fecha_ingreso', '<=', $fecha_ingreso->addHours(24))
                ->get()
                ->sortBy('nombre');
        }
        elseif ($nombre_paciente && !$request->get('fecha_ingreso'))
        {
            $pacientes = Pacientes::where('nombre', 'like', '%' . $request->get('buscar_nombre_paciente') . '%')
                ->orWhere('apellidos', 'like', '%' . $request->get('buscar_nombre_paciente') . '%')
                ->get()
                ->sortBy('nombre');
        }
        elseif ($fecha_ingreso && $nombre_paciente)
        {
            $pacientes = Pacientes::where('nombre', 'like', '%' . $request->get('buscar_nombre_paciente') . '%')
                ->orWhere('apellidos', 'like', '%' . $request->get('buscar_nombre_paciente') . '%')
                ->orwhere('fecha_ingreso', '>=', $fecha_ingreso)
                ->where('fecha_ingreso', '<=', $fecha_ingreso->addHours(24))
                ->get()
                ->sortBy('nombre');
        }
        else
        {
            return redirect()->route('crear_una_asignacion')
                ->with('warning','No se encontro el nombre del paciente.');
        }

        if ($pacientes->count() > 0) {
            return response()->json($pacientes);
//            return view('usuario_interno.asignacion', array('pacientes' => $pacientes));
        }
        else {
            return redirect()->route('crear_una_asignacion')
                ->with('warning','No se encontro el nombre del paciente.');
        }
    }

    /**
     * Buscar usuario externo por nombre, apellidos, correo o usuario
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    public function buscarUsuarioExterno(Request  $request)
    {
        $buscarUsuarioExterno = $request->get('buscar_usuario_externo');

        if ($buscarUsuarioExterno){
            $usuariosExternos = UsuariosExternos::where('nombre', 'like', '%' . $buscarUsuarioExterno . '%')
                ->orWhere('apellidos', 'like', '%' . $buscarUsuarioExterno . '%')
                ->orWhere('correo', $buscarUsuarioExterno)
                ->orWhere('usuario', $buscarUsuarioExterno)
                ->get()
                ->sortBy('nombre');
            if ($usuariosExternos->count() > 0){
                return view('usuario_interno.asignacion', array('usuariosExternos' => $usuariosExternos));
            }
            else{
                return redirect()->route('crear_una_asignacion')
                    ->with('warning','No se encontro el nombre del usuario externo.');
            }
        }
        else {
            return redirect()->route('crear_una_asignacion')
                ->with('warning','No se encontro el nombre del usuario externo.');
        }
    }

    /**
     * Buscar asignaciones por nombre de paciente y fecha de ingreso del paciente
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function buscarAsignacionesPorPaciente(Request $request)
    {
        $nombre_paciente = $request->get('buscar_nombre_paciente');
        $fecha_ingreso = CarbonImmutable::make($request->get('fecha_ingreso'));

        $idsPacientes = new Collection();

        //Si la fecha es verdadera y nombre es falso
        if ($fecha_ingreso && !$nombre_paciente)
        {
            //Busca todos los pacientes con la fecha ingresada
            $pacientes = Pacientes::where('fecha_ingreso', '>=', $fecha_ingreso)
                ->where('fecha_ingreso', '<=', $fecha_ingreso->addHours(24))
                ->get()
                ->sortBy('nombre');
        }
        //Si el nombre es verdadero pero la fecha no
        elseif ($nombre_paciente && !$request->get('fecha_ingreso'))
        {
            //Busca todos los pacientes por nombre o  apellidos
            $pacientes = Pacientes::where('nombre', 'like', '%' . $request->get('buscar_nombre_paciente') . '%')
                ->orWhere('apellidos', 'like', '%' . $request->get('buscar_nombre_paciente') . '%')
                ->get()
                ->sortBy('nombre');
        }
        else {
            return redirect()->route('ver_asignaciones')
                ->with('warning','No se encontraron asignaciones.');
        }

        //Si pacientes es mayor a 0, entra
        if ($pacientes->count() > 0)
        {
            //Se guardan los ids de todos los pacientes de acuerdo a la fecha de ingreso o nombre o apellidos
            foreach ($pacientes as $paciente){
                $idsPacientes->push($paciente->id);
            }
        }

        //Si la coleccion idsPacientes es mayor a 0, entra
        if ($idsPacientes->count() > 0)
        {
            $relaciones = RelacionesUsuariosExternosConPacientes::whereIn('id_paciente', $idsPacientes->toArray())
                ->get()
                ->sortBy('id_paciente');

            //Si relaciones es mayor a 0, entra
            if ($relaciones->count() > 0) {
                return view('usuario_interno.asignaciones', array('relaciones' => $relaciones));
            }
            else{
                return redirect()->route('ver_asignaciones')
                    ->with('warning','No se encontraron asignaciones.');
            }
        }
        else {
            return redirect()->route('ver_asignaciones')
                ->with('warning','No se encontraron asignaciones.');
        }
    }
}
