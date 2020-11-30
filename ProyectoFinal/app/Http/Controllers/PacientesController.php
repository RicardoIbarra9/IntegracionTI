<?php

namespace App\Http\Controllers;

use App\Pacientes;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Pacientes::all()
            ->sortBy('nombre');
        return view('usuario_interno.inicio', array('pacientes' => $pacientes));
    }

    /**
     * Buscador de pacientes
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function buscarNombre(Request $request)
    {
        $pacientes = Pacientes::where('nombre', 'like', '%' . $request->get('buscar_nombre_paciente') . '%')
            ->orWhere('apellidos', 'like', '%' . $request->get('buscar_nombre_paciente') . '%')
            ->get()
            ->sortBy('nombre');

        if ($pacientes->count() > 0)
        {
            return view('usuario_interno.inicio', array('pacientes' => $pacientes));
        }
        else
        {
            return redirect()->route('inicio_usuario_interno')
                ->with('warning','No se encontro el nombre del paciente.');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('usuario_interno.pacientes');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'nullable',
            'sexo' => 'required',
            'fecha_ingreso' => 'required',
            'motivo_ingreso' => 'nullable',
//            'fecha_alta' => 'nullable',
//            'motivo_alta' => 'nullable',
//            'fecha_muerte' => 'nullable',
//            'motivo_muerte' => 'nullable',
            'diagnostico' => 'nullable',
        ]);

        Pacientes::create($request->all());

        return redirect()->route('inicio_usuario_interno')->with('success','Paciente creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function show(Pacientes $pacientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Pacientes $pacientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pacientes $pacientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pacientes $pacientes)
    {
        //
    }

    public function alta_o_baja($id)
    {
        $paciente = Pacientes::find($id);
        return view('usuario_interno.alta_o_defuncion', array('paciente' => $paciente));
    }

    /**
     * @param $id
     * @param Request $request
     * Guarda la alta o la muerte en la bd
     */
    public function alta_o_baja_guardar($id, Request $request)
    {
        $request->validate([
            'alta_defuncion' => 'required',
            'fecha' => 'required',
            'motivo' => 'required',
        ]);

        $paciente = Pacientes::find($id);

        if ($request->get('alta_defuncion') == 1)
        {
            $paciente->fecha_alta = $request->get('fecha');
            $paciente->motivo_alta = $request->get('motivo');
        }
        else if ($request->get('alta_defuncion') == 0)
        {
            $paciente->fecha_muerte = $request->get('fecha');
            $paciente->motivo_muerte = $request->get('motivo');
        }

        $paciente->save();

        return redirect()->route('inicio_usuario_interno')->with('success','Datos actualizados.');
    }

    /**
     * Muestra todas las notificaciones por paciente
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notificacionesPorPaciente($id)
    {
        $paciente = Pacientes::find($id);
        return view('usuario_interno.ver_notificaciones', array('paciente' => $paciente));
    }

    public function crearNotificacion($id)
    {
        $paciente = Pacientes::find($id);
        return view('usuario_interno.crear_notificacion', array('paciente' => $paciente));
    }
}
