<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\registerController;

Route::get('/', function () {
    return view('mainView');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/register',  [registerController::class, 'showRegisterForm'])->name('register');

Route::post('/register',  [registerController::class, 'formRegister'])->name('register.submit');

Route::get('/login',  [LoginAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginAuthController::class, 'formValidation'])->name('login.submit');

Route::post('/logout', [logoutController::class, 'logoutAndDestroy'])->name('logout.submit');

Route::get('/menu', function () {
    return view('main.menu');
})->middleware('auth');



