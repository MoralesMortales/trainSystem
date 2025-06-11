<?php

use App\Http\Controllers\cityController;
use App\Http\Controllers\createEmployee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\newReservation;
use App\Http\Controllers\registerController;
use App\Http\Controllers\RestringedArea;
use App\Http\Controllers\trainController;
use App\Http\Controllers\travelController;

Route::get('/', function () {
    return view('mainView');
});

// Auth

Route::get('/register',  [registerController::class, 'showRegisterForm'])->name('register');

Route::post('/register',  [registerController::class, 'formRegister'])->name('register.submit');

Route::get('/login',  [LoginAuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginAuthController::class, 'formValidation'])->name('login.submit');

Route::post('/logout', [logoutController::class, 'logoutAndDestroy'])->name('logout.submit');

// Menu

Route::get('/menu', function () {
    return view('main.menu');
})->middleware('auth')->name('menu');

// Trains

Route::get('/menu/createTrain', [trainController::class, 'createTrain'])->middleware('auth')->name('createTrain');

Route::get('/menu/updateTrain/{train}', [trainController::class, 'updateTrain'])->middleware('auth')->name('updateTrain');

Route::put('/menu/updateTrain/{train}', [trainController::class, 'updateTrainSubmit'])->middleware('auth')->name('updateTrain.submit');

Route::post('/menu/createTrain', [trainController::class, 'createTrainSubmit'])->middleware('auth')->name('createTrain.submit');

Route::get('/menu/trains', [trainController::class, 'showMyTrains'])->middleware('auth')->name('Trains');

Route::delete('/menu/trains/{train}', [trainController::class, 'destroy'])->middleware('auth')->name('Trains.destroy');

// Employee Management

Route::get('/menu/menuemployee', action: function () {
    return view('main/EmployeeCreation/menuEmployee');
});

Route::get('/menu/menuemployee/manageemployees', action: function () {
    return view('main/EmployeeCreation/ManageEmployees');
});

Route::get('/menu/menuemployee/createEmployee', [createEmployee::class, 'showCreateEmployee'])->middleware('auth')->name('showEmployeeBase');

Route::get('/admin/menuemployee/createEmployee', [createEmployee::class, 'showCreateEmployeeAdmin'])->name('showEmployeeAdmin');

Route::post('/admin/menuemployee/createEmployee/password', [RestringedArea::class, 'RestringedAreaSubmit'])->name('restringed.submit');

Route::post('/admin/menuemployee/createEmployee', [RestringedArea::class, 'createEmployeeSubmit'])->name('createEmployeeFr.submit');

Route::get('/admin/menuemployee/createEmployee/confirmEmployee', [RestringedArea::class, 'openConfirmEmployeeView'])->name('openConfirmEmployeeView');

Route::post('/admin/menuemployee/createEmployee/confirmEmployee/', [RestringedArea::class, 'confirm'])->name('confirmCreateEmployee.submit');

// Reservations

Route::get('/menu/newreservation', [newReservation::class, 'showCreateAvailableReservations'])->name('showAvailableReservations');

Route::get('/menu/newreservation/{travel}', [newReservation::class, 'reservingTravel'])->name('reservingTravel');

Route::post('/menu/newreservation/', [newReservation::class, 'reservingTravelStep2'])->name('reservingTravelStep2.submit');

Route::get('/menu/myreservation/viewreservation', function () {
    return view('main/Reservation/ViewReservation');
});

Route::get('/menu/myreservation/editreservation', function () {
    return view('main/Reservation/EditReservation');
});

Route::get('/menu/newreservation/reserving/onlyme', [newReservation::class, 'reservingonlyme'])->name('reservingOnlyme');

Route::get('/menu/newreservation/reserving/meandothers', [newReservation::class, 'reservingMeAndOthers'])->name('reservingMeAndOthers');

Route::post('/menu/newreservation/reserving/meandothers', [newReservation::class, 'reservingMeAndOthersPostPost'])->name('reservingMeAndOthersPost');

Route::get('/menu/newreservation/reserving/others', [newReservation::class, 'reservingOthers'])->name('reservingOthers');

// Travel

Route::get('/menu/newtravel', [travelController::class, 'showCreateTravelView'])->name('showCreateTravel');

Route::post('/menu/newtravel', [travelController::class, 'postCreateTravelView'])->name('CreateTravel.submit');

Route::get('/menu/mytravel', [travelController::class, 'showMyTravelView'])->name('showMyTravel');

//Cities


Route::get('/menu/managecitys', [cityController::class, 'showCities'])->name('showCities');

Route::post('/menu/managecitys', [cityController::class, 'store'])->name('cities.store');

Route::delete('/menu/managecitys/{city}', [cityController::class, 'destroy'])->name('cities.destroy');

