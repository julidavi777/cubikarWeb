<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/employees');
        } else {
            return redirect()->back()->withInput()->withErrors(['login' => 'Usuario o contraseña incorrectos']);
        }
    }
    public function logout()
{
    Auth::logout();
    return redirect('/login'); // Redirige a la página de inicio o a donde desees después del cierre de sesión
}
}
