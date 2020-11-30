<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //Si el usuario no esta logeado lo manda al login de usuario externo
        if (! $request->expectsJson()) {
            if (!Auth::guard('usuario_externo')->check()){
                return route('login_usuario_externo');
            }

            if (!Auth::guard('usuario_interno')->check()){
                return route('login_usuario_interno');
            }
        }
    }
}
