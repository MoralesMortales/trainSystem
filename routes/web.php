<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\trainController;

Route::get('/', function () {
    return view('mainView');
});


Route::get('/register',  [registerController::class, 'showRegisterForm'])->name('register');

Route::post('/register',  [registerController::class, 'formRegister'])->name('register.submit');

Route::get('/login',  [LoginAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginAuthController::class, 'formValidation'])->name('login.submit');

Route::post('/logout', [logoutController::class, 'logoutAndDestroy'])->name('logout.submit');

Route::get('/menu', function () {
    return view('main.menu');
})->middleware('auth')->name('menu');

Route::get('/menu/createTrain', [trainController::class, 'createTrain'])->middleware('auth')->name('createTrain');

Route::post('/menu/createTrain', [trainController::class, 'createTrainSubmit'])->middleware('auth')->name('createTrain.submit');

Route::get('/menu/trains', [trainController::class, 'showMyTrains'])->middleware('auth')->name('Trains');


