<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function createEmployeeSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
            'Privileges' => 'sometimes|boolean',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'El email no está registrado en nuestro sistema',
            ])->withInput();
        }

        if ($validatedData['Privileges']) {
            $user->isEmployee = 2;
        } else {
            $user->isEmployee = 1;
        }

        $userToUpgrade = $user;

        return redirect()->route('menu')->with('theUser', $userToUpgrade);

    }
}
