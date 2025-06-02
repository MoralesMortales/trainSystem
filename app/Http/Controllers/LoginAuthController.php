<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function formValidation(Request $request)
    {
    $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
    ]);

    if (Auth::attempt($validatedData)) {
        $request->session()->regenerate();
        return redirect()->intended('menu');
    }

    return back()->withErrors([
        'email' => 'El correo electrónico o contraseña son incorrectos',
    ])->onlyInput('email');
}}
