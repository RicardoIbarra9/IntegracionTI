<?php

namespace App\Http\Controllers;

use App\UsuariosExternos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuariosExternosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $usuariosExternos = UsuariosExternos::all();
//
//        return view('usuarios.index', $usuariosExternos);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('usuario_externo.registro');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required',
            'usuario' => 'required|unique:usuarios_externos',
            'password' => 'required',
            'contrasena-confirmada' => 'required|same:password',
        ]);

        $nuevoUsuario = new UsuariosExternos();
        $nuevoUsuario->nombre = $request->get('nombre');
        $nuevoUsuario->apellidos = $request->get('apellidos');
        $nuevoUsuario->sexo = $request->get('sexo');
        $nuevoUsuario->fecha_nacimiento = $request->get('fecha_nacimiento');
        $nuevoUsuario->email = $request->get('email');
        $nuevoUsuario->usuario = $request->get('usuario');
        $nuevoUsuario->password = Hash::make($request->get('password'));

        $nuevoUsuario->save();

        return redirect()->route('login_usuario_externo')
            ->with('success','Cuenta creada.');
    }

    /**
     * Display the specified resource.
     * @param UsuariosExternos $usuariosExternos
     */
    public function show(UsuariosExternos $usuariosExternos)
    {
//        return view('posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsuariosExternos  $usuariosExternos
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuariosExternos $usuariosExternos)
    {
//        return view('posts.edit');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required',
            'usuario' => 'required|unique:usuarios_externos',
            'password' => 'required',
            'contrasena-confirmada' => 'required|same:password',
        ]);

        $usuarioExterno = UsuariosExternos::find($id);
        $usuarioExterno->update($request->all());

        return redirect()
            ->route('inicio_usuario_externo')
            ->with('success','Datos actualizados.');
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     */
    public function destroy($id)
    {
//        $usuarioExterno = UsuariosExternos::find($id);
//        $usuarioExterno->delete();

//        return redirect()->route('')
//            ->with('success','Usuario externo eliminado.');
    }

    /**
     * Iniciar sesion
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
        if (Auth::guard('usuario_externo')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('inicio_usuario_externo'));
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
        Auth::guard('usuario_externo')
            ->logout();
        return redirect()->route('login_usuario_externo');
    }

    /**
     * Formulario del login
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function loginForm()
    {
        if (Auth::guard('usuario_externo')->check()){
            return redirect()
                ->route('inicio_usuario_externo');
        }

        return view('usuario_externo.login');
    }

    /**
     * Muestra la pagina de inicio para que inicie usuario externo o interno
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function paginaInicio()
    {
        if (Auth::guard('usuario_externo')->check()){
            return redirect()
                ->route('inicio_usuario_externo');
        }

        if (Auth::guard('usuario_interno')->check()){
            return redirect()
                ->route('inicio_usuario_interno');
        }

        return view('inicio');
    }
}
