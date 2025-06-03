<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\logoutController;

Route::get('/', function () {
    return view('mainView');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/employeemainview', function () {
    return view('auth/EmployeeMainView');
});


Route::get('/createtrain', function () {
    return view('auth/CreateTrain');
});

Route::get('/edittrains', function () {
    return view('auth/EditTrains');
});

Route::get('/login',  [LoginAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginAuthController::class, 'formValidation'])->name('login.submit');

Route::post('/logout', [logoutController::class, 'logoutAndDestroy'])->name('logout.submit');

Route::get('/menu', function () {
    return view('main.menu');
})->middleware('auth');



