<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;

Route::get('/', function () {
    return view('mainView');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/login',  [LoginAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginAuthController::class, 'formValidation'])->name('login.submit');

Route::get('/menu', function () {
    return view('main.menu');
})->middleware('auth');



