<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class createEmployee extends Controller
{
    public function showCreateEmployeeAdmin()
    {
        return view('main.EmployeeCreation.createEmployee');
    }


    public function showCreateEmployee()
    {
        return view('main.EmployeeCreation.createEmployee');
    }

    public function formValidation(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->route('menu')->with('success', 'User logged successfully!');
        }

        return back()->withErrors([
            'email' => 'The email or password are wrong',
        ])->onlyInput('email');
    }
}

