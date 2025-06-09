<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestringedArea extends Controller
{
    public function RestringedAreaSubmit(Request $request)
    {

        $validatedData = $request->validate([
            'password' => 'required|string',
        ]);

        if ($validatedData['password'] == "87654321") {
            $allowAccess = true;
            return redirect()->route('createAdmin')->with('allowAccess', $allowAccess);
        }
        return back()->with('error', 'Contraseña incorrecta'); // <- ¡Nuevo!
    }
}
