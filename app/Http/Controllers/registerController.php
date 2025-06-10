<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{

    public function showRegisterForm()
    {
        return view('auth.register');
    }


    public function formRegister(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'cedula' => 'required|string|unique:users,cedula',
            'password_1' => 'required|string|min:8',
            'password_2' => 'required|string|min:8|same:password_1'
        ]);


            $user = new User();

            $user->email = $validatedData['email'];

            $user->cedula = $validatedData['cedula'];

            $user->password = Hash::make($validatedData['password_1']);

            $user->isEmployee = 0;

            $user->save();

            return redirect()->route('menu')->with('success', 'User created successfully!');
    }
}
