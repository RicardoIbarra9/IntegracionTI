<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UsuarioExtenoAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Verifica que el usuario este logeado
        if (Auth::guard('usuario_externo')->check())
            return $next($request);
        return redirect('/');
    }
}
