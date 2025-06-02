<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;

Route::get('/', function () {
    return view('mainView');
});

Route::get('/login',  [LoginAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',  [LoginAuthController::class, 'formValidation'])->name('login.submit');

