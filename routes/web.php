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
Route::get('riwayat/{no_cm}', 'PasienController@Riwayat');

// ============ TEMPLATE FRONT END

Route::get('templateASD', function () {
    return view('pages.template');
});

Route::get('logActivities', function () {
    return view('pages.admin.logActivities');
});

Route::get('managementUser', function () {
    return view('pages.admin.managementUser');
});

Route::get('historicalList', function () {
    return view('pages.admin.historicalList');
});

Route::get('uploadFile', function () {
    return view('pages.admin.uploadFile');
});

Route::get('subNavbar', function () {
    return view('includes.admin.navbar');
});

// ============ END OF TEMPLATE FRONT END



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

Route::post('diagnosa/{no_cm}', 'DiagnosaController@storeDiagnosaAwal');
Route::post('diagnosaAkhir', 'DiagnosaController@storeDiagnosaAkhir');
Route::post('pilihDokter/{no_cm}', 'DiagnosaController@storePilihDokter');
Route::post('batalPeriksa/{no_pendaftaran}', 'PasienController@storeBatalPeriksa');
