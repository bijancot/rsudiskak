<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('layout', function() {
    return view('layout');
});

Route::get('listPasien', function() {
    return view('listPasien');
});

Route::get('dataPasien', function() {
    return view('dataPasien');
});

Route::get('diagnosa', function() {
    return view('diagnosa');
});

Route::get('login', function() {
    return view('login');
});