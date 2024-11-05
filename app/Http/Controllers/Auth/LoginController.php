<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Método de inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->intended('/')
                             ->with('status', 'success'); // Enviamos un mensaje de éxito
        }

        // Autenticación fallida
        return redirect()->back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Método de cierre de sesión
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Redirige al usuario a la página de inicio de sesión
    }
}

