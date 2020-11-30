<?php

namespace App\Http\Controllers;

use App\UsuarioInterno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioInternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('usuario_interno.usuario_interno.registro');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_usuario' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'email' => 'required',
            'usuario' => 'required|unique:usuario_internos',
            'password' => 'required',
            'contrasena-confirmada' => 'required|same:password',
        ]);

        $nuevoUsuario = new UsuarioInterno();
        $nuevoUsuario->tipo_usuario = $request->get('tipo_usuario');
        $nuevoUsuario->nombre = $request->get('nombre');
        $nuevoUsuario->apellidos = $request->get('apellidos');
        $nuevoUsuario->sexo = $request->get('sexo');
        $nuevoUsuario->email = $request->get('email');
        $nuevoUsuario->usuario = $request->get('usuario');
        $nuevoUsuario->password = Hash::make($request->get('password'));

        $nuevoUsuario->save();

        return redirect()->route('inicio_usuario_interno')
            ->with('success','Usuario Interno Registrado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsuarioInterno  $usuarioInterno
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioInterno $usuarioInterno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsuarioInterno  $usuarioInterno
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuarioInterno $usuarioInterno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsuarioInterno  $usuarioInterno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuarioInterno $usuarioInterno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsuarioInterno  $usuarioInterno
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuarioInterno $usuarioInterno)
    {
        //
    }

    /**
     * Login
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:1'
        ]);

        // Attempt to log the user in
        if (Auth::guard('usuario_interno')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('inicio_usuario_interno'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email'));
    }

    /**
     * Cerrar sesion
     * @return \Illuminate\Http\RedirectResponse
     */

    public function logout()
    {
        Auth::guard('usuario_interno')
            ->logout();
        return redirect()->route('login_usuario_interno');
    }

    /**
     * Formulario del login
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function loginForm()
    {
        //Si ya esta logeado lo manda a la pagina de inicio
        if (Auth::guard('usuario_interno')->check()){
            return redirect()
                ->route('inicio_usuario_interno');
        }

        return view('usuario_interno.usuario_interno.login');
    }
}
