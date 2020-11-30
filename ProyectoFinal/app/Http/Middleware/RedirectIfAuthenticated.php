<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "usuario_externo" && Auth::guard($guard)->check()) {
            return redirect('/notificaciones');
        }

        if ($guard == "usuario_interno" && Auth::guard($guard)->check()) {
            return redirect('/inicio');
        }

        //Si nadie esta logeado se envia a la sigueinte ruta
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
