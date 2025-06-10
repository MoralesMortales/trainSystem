<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\json_decode;

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

    public function openConfirmEmployeeView()
    {
        $user = session('theUser');

        return view('main/EmployeeCreation/ConfirmEmployee')->with('theUser', $user);
    }

    public function createEmployeeSubmit(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|max:255',
            ]);

            if ($request->has('Privileges')) {
                $privileges = True;
            } else {
                $privileges = false;
            }


            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('showPassword', false)->withErrors([
                    'email' => 'El email no está registrado en nuestro sistema',
                ])->withInput();
            }

            if ($privileges) {
                $user->isEmployee = 2;
            } else {
                $user->isEmployee = 1;
            }

            $userToUpgrade = $user;

            session(['theUser' => $userToUpgrade]);

            if (Auth::user()) {
                return redirect()->route('openConfirmEmployeeView');
            } else {
                $userToUpgrade->save();
                return redirect()->route('login');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->with('showPassword', false)
                ->withErrors($e->validator)
                ->withInput();
        }
    }
    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|string',
        ]);

        $userData = json_decode($request->input('userData'), true);

        $myuser = Auth::user();

        dd($userData->email);

        if (Hash::check($validatedData['password'], $myuser->password)) {
            $userToUpdate->save();
            return redirect()->route('menu');
        }

        return back()->with('error', 'Contraseña incorrecta');
    }
}
