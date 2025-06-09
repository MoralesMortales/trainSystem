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
            $showPassword = false;
            return redirect()->route('showEmployeeAdmin')->with('showPassword', $showPassword);
        }
            return back()->with('error', 'Contraseña incorrecta');
    }
}
