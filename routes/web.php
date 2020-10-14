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
    return view('pages.login');
});

Route::get('layout', function () {
    return view('layouts.layout');
});

Route::get('admin', 'AdminController@adminPage')->name('admin')->middleware('adminRole');
Route::get('listPasien', 'PasienController@listPasien')->name('perawat')->middleware('perawatRole');
Route::get('diagnosa/{no_cm}', 'DiagnosaController@diagnosaAwal')->name('dokter')->middleware('dokterRole');
Route::get('login', function () {
    return view('pages.login');
});

Route::get('listPasien', 'PasienController@listPasien');
Route::get('dataPasien/{no_cm}', 'PasienController@DataPasien');

Route::get('pilihDokter/{no_cm}', 'DiagnosaController@pilihDokter');

Route::get('diagnosa/{no_cm}', 'DiagnosaController@diagnosaAwal');
Route::get('diagnosaAkhir/{no_cm}', 'DiagnosaController@diagnosaAkhir');

Route::get('listPasienKirimPoli', 'PasienController@ListPasienKirimPoli');
Route::get('listPasienHasilLab', 'PasienController@ListPasienHasilLab');

Route::get('dataResep', 'DiagnosaController@DataResep');
Route::get('riwayat', 'PasienController@Riwayat');

Route::get('subNavbar', function () {
    return view('includes.subNavbar');
});

Route::get('navbar', function () {
    return view('includes.navbar');
});

Route::get('footer', function () {
    return view('includes.footer');
});
// ======= 
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::post('diagnosa', 'DiagnosaController@storeDiagnosaAwal');
Route::post('pilihDokter/{no_cm}', 'DiagnosaController@storePilihDokter');
Route::post('batalPeriksa/{no_pendaftaran}', 'PasienController@storeBatalPeriksa');
