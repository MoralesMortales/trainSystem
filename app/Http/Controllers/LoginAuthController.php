<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAuthController extends Controller
{
        public function showLoginForm()
    {
        return view('auth.login');     }

    public function formValidation(Request $request){

    }

}
