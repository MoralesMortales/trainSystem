<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mainView');
});
Route::get('/login', function () {
    return view('register/login');
});
