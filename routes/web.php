<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mainView');
});
Route::get('/hola', function () {
    return view('hola');
});
