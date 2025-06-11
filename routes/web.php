<?php

use App\Http\Controllers\createEmployee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\newReservation;
use App\Http\Controllers\registerController;
use App\Http\Controllers\RestringedArea;
use App\Http\Controllers\trainController;
use App\Http\Controllers\travelController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CityController; // <-- Añade esta línea

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

Route::get('/menu/menuemployee/manageemployees', [EmployeeController::class, 'manageEmployees'])->name('manage.employees');

Route::get('/menu/menuemployee', action: function () {
    return view('main/EmployeeCreation/menuEmployee');
});

Route::delete('/menu/menuemployee/{user}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // <-- AÑADE ESTA LÍNEA

Route::get('/menu/menuemployee/createEmployee', [createEmployee::class, 'showCreateEmployee'])->middleware('auth')->name('showEmployeeBase');

Route::get('/admin/menuemployee/createEmployee', [createEmployee::class, 'showCreateEmployeeAdmin'])->name('showEmployeeAdmin');

Route::post('/admin/menuemployee/createEmployee/password', [RestringedArea::class, 'RestringedAreaSubmit'])->name('restringed.submit');

Route::post('/admin/menuemployee/createEmployee', [RestringedArea::class, 'createEmployeeSubmit'])->name('createEmployeeFr.submit');

Route::get('/admin/menuemployee/createEmployee/confirmEmployee', [RestringedArea::class, 'openConfirmEmployeeView'])->name('openConfirmEmployeeView');

Route::post('/admin/menuemployee/createEmployee/confirmEmployee/', [RestringedArea::class, 'confirm'])->name('confirmCreateEmployee.submit');

// Reservations

Route::get('/menu/newreservation', [newReservation::class, 'showCreateAvailableReservations'])->name('showAvailableReservations');


Route::get('/menu/myreservation', function () {
    return view('main/Reservation/MyReservations');
});

Route::get('/menu/myreservation/viewreservation', function () {
    return view('main/Reservation/ViewReservation');
});

Route::get('/menu/myreservation/editreservation', function () {
    return view('main/Reservation/EditReservation');
});

Route::get('/menu/newreservation/reserving', function () {
    return view('main/Reservation/Reserving/Reserving');
});

Route::get('/menu/newreservation/reserving/onlyme', function () {
    return view('main/Reservation/Reserving/OnlyMe');
});

Route::get('/menu/newreservation/reserving/meandothers', function () {
    return view('main/Reservation/Reserving/MeandOthers');
});

Route::get('/menu/newreservation/reserving/others', function () {
    return view('main/Reservation/Reserving/Others');
});

// Travel

// Rutas para la gestión de viajes
Route::get('/menu/newtravel', [travelController::class, 'showCreateTravelView'])->name('showCreateTravel');
Route::post('/travels', [travelController::class, 'storeTravel'])->name('travels.store'); // Ruta para guardar el viaje

Route::get('/menu/mytravels', function () {
    return view('main/Travel/MyTravels');
});

Route::get('/menu/mytravels/viewtravel', function () {
    return view('main/Travel/ViewTravel');
});

Route::get('/menu/mytravels/edittravel', function () {
    return view('main/Travel/EditTravel');
});

// Rutas para la gestión de ciudades
Route::get('/menu/managecitys', [CityController::class, 'manageCities'])->name('cities.manage');
Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
Route::delete('/cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');

Route::get('/menu/reports', function () {
    return view('main/makereport');
});


// Reports

Route::get('/menu/reports', function () {
    return view('main/Report/makereport');
});

Route::get('/menu/reports/reservations', function () {
    return view('main/Report/reservations');
});

Route::get('/menu/reports/seasonaltrips', function () {
    return view('main/Report/seasonalTrips');
});

Route::get('/menu/reports/canceled', function () {
    return view('main/Report/canceled');
});

Route::get('/menu/reports/destiny', function () {
    return view('main/Report/destiny');
});