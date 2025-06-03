<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Asegúrate de importar esto
use Illuminate\Http\RedirectResponse; // Para el tipo de retorno
use Illuminate\Http\Request;

class logoutController extends Controller
{
    //
    public function logoutAndDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
