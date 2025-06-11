<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class registerController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function formRegister(Request $request)
    {
        $validatedData = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
                'regex:/^.+@.+\..+$/'
            ],
            'cedula' => [
                'required',
                'integer', // Ensures it's a whole number
                'min:0',   // Ensures it's not negative
                Rule::unique('users', 'cedula'),
                'digits_between:1,15' // Optional: You might want to define a min/max length for cedula
                                      // Adjust 15 to the max expected length of a cedula in your region.
                                      // If it has a fixed length (e.g., 8 digits), you could use 'digits:8'
            ],
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