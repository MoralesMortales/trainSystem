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

Route::get('/register',  [registerController::class, 'showRegisterForm'])->name('register');

Route::post('/register',  [registerController::class, 'formRegister'])->name('register.submit');

Route::get('/login',  [LoginAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginAuthController::class, 'formValidation'])->name('login.submit');

Route::post('/logout', [logoutController::class, 'logoutAndDestroy'])->name('logout.submit');

Route::get('/menu', function () {
    return view('main.menu');
})->middleware('auth')->name('menu');

Route::get('/menu/createTrain', [trainController::class, 'createTrain'])->middleware('auth')->name('createTrain');

Route::get('/menu/updateTrain/{train}', [trainController::class, 'updateTrain'])->middleware('auth')->name('updateTrain');

Route::put('/menu/updateTrain/{train}', [trainController::class, 'updateTrainSubmit'])->middleware('auth')->name('updateTrain.submit');

Route::post('/menu/createTrain', [trainController::class, 'createTrainSubmit'])->middleware('auth')->name('createTrain.submit');

Route::get('/menu/trains', [trainController::class, 'showMyTrains'])->middleware('auth')->name('Trains');

Route::delete('/menu/trains/{train}', [trainController::class, 'destroy'])->middleware('auth')->name('Trains.destroy');



Route::get('/menu/createEmployee', function () {
    return view('main/EmployeeCreation/createEmployee');
});

Route::get('/menu/createEmployee/confirmEmployee', function () {
    return view('main/EmployeeCreation/ConfirmEmployee');
});

Route::get('/menu/createReservation', function () {
    return view('main/Reservation/Reserving');
});