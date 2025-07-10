<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUsuario
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login.form')->withErrors(['Acceso denegado. Inicia sesión.']);
        }

        return $next($request);
    }
}
