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
    return view('layouts.layout');
});



Route::get('login', function() {
    return view('pages.login');
});

Route::get('listPasien', function() {
    return view('pages.listPasien');
});

Route::get('listPasienKirimPoli', function() {
    return view('pages.listPasienKirimPoli');
});

Route::get('listPasienHasilLab', function() {
    return view('pages.listPasienHasilLab');
});

Route::get('dataPasien', function() {
    return view('pages.dataPasien');
});

Route::get('dataResep', function() {
    return view('pages.dataResep');
});

Route::get('diagnosa', function() {
    return view('pages.diagnosa');
});

Route::get('diagnosaAkhir', function() {
    return view('pages.diagnosaAkhir');
});

Route::get('riwayat', function() {
    return view('pages.riwayat');
});





Route::get('subNavbar', function() {
    return view('includes.subNavbar');
});

Route::get('navbar', function() {
    return view('includes.navbar');
});

Route::get('footer', function() {
    return view('includes.footer');
});