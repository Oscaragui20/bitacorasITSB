<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'contraseña' => 'required',
        ]);

        $usuario = Usuario::where('nombre', $request->nombre)->first();

        if ($usuario && Hash::check($request->contraseña, $usuario->contraseña)) {
            // Guardar usuario en sesión manualmente
            session(['usuario' => $usuario]);

            return redirect('/bitacoras')->with('success', 'Bienvenido, ' . $usuario->nombre);
        }

        return back()->withErrors(['nombre' => 'Credenciales incorrectas']);
    }

    // Cerrar sesión
    public function logout()
    {
        session()->forget('usuario');

        return redirect('/login')->with('success', 'Sesión cerrada correctamente.');
    }
}
