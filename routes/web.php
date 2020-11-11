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
Route::get('logActivities', function () {
    return view('pages.admin.logActivities');
})->middleware('adminRole')->name('admin');
//Route::get('admin', 'AdminController@adminPage')->name('admin')->middleware('adminRole');
Route::get('login', function () {
    return view('pages.login');
});

Route::get('listPasien', 'PasienController@listPasien');
Route::get('dataPasien/{no_cm}', 'PasienController@DataPasien');

Route::get('pilihDokter/{no_cm}', 'DiagnosaController@pilihDokter');
Route::get('pilihForm/{no_cm}/{no_pendaftaran}', 'FormPengkajianController@pilihForm');

Route::get('diagnosa/{no_cm}', 'DiagnosaController@diagnosaAwal');
Route::get('diagnosaAkhir/{no_cm}', 'DiagnosaController@diagnosaAkhir');

Route::get('listPasienKirimPoli', 'PasienController@ListPasienKirimPoli');
Route::get('listPasienHasilLab', 'PasienController@ListPasienHasilLab');

Route::get('dataResep', 'DiagnosaController@DataResep');
Route::get('riwayat/{no_cm}', 'PasienController@Riwayat');

Route::get('formPengkajianAwal/{no_cm}', 'FPengkajianAwalController@showRajal');
Route::get('formPengkajianUlang/{no_cm}', 'FPengkajianUlangController@showRajal');
Route::get('formPengkajian/{idForm}/{no_cm}/{noPendaftaran}', 'FormPengkajianController@formPengkajian');


// ============ TEMPLATE FRONT END

Route::get('templateASD', function () {
    return view('pages.template');
});

Route::get('logActivities', function () {
    return view('pages.admin.logActivities');
});


Route::get('m_pendidikan', 'PendidikanController@index');
Route::get('m_pekerjaan', 'PekerjaanController@index');
Route::get('m_agama', 'AgamaController@index');
Route::get('m_nilaiAnut', 'NilaiAnutController@index');
Route::get('m_statusPernikahan', 'StatusPernikahanController@index');
Route::get('m_keluarga', 'KeluargaController@index');
Route::get('m_tempatTinggal', 'TempatTinggalController@index');
Route::get('m_statusPsikologi', 'StatusPsikologiController@index');
Route::get('m_hambatanEdukasi', 'HambatanEdukasiController@index');
Route::get('manajemen_form', 'ManajemenFormController@index');

Route::get('managementUser', function () {
    return view('pages.admin.managementUser');
});

Route::get('historicalList', function () {
    return view('pages.admin.historicalList');
});

Route::get('uploadFile', function () {
    return view('pages.admin.uploadFile');
});

Route::get('pengkajianAwalPasien', function () {
    return view('pages.formPengkajian.pengkajianAwalPasien');
});

Route::get('pengkajianUlangPasien', function () {
    return view('pages.formPengkajian.pengkajianUlangPasien');
});

Route::get('profilRingkasMedis', function () {
    return view('pages.formPengkajian.profilRingkasMedis');
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
Route::post('pilihForm/{no_cm}/{noPendaftaran}', 'FormPengkajianController@storePilihForm');
Route::post('batalPeriksa/{no_pendaftaran}', 'PasienController@storeBatalPeriksa');
Route::post('batalForm', 'FormPengkajianController@storeBatalForm');
Route::post('formPengkajian/{idForm}/{no_cm}/{noPendaftaran}/{subForm}/{isLastSubForm}', 'FormPengkajianController@storeFormPengkajian');

/**
 * Route post Admin
 */
Route::post('m_pendidikan', 'PendidikanController@store');
Route::delete('m_pendidikan/{pendidikan}', 'PendidikanController@destroy');

Route::post('m_pekerjaan', 'PekerjaanController@store');
Route::delete('m_pekerjaan/{pekerjaan}', 'PekerjaanController@destroy');

Route::post('m_agama', 'AgamaController@store');
Route::delete('m_agama/{agama}', 'AgamaController@destroy');

Route::post('m_nilaiAnut', 'NilaiAnutController@store');
Route::delete('m_nilaiAnut/{nilaiAnut}', 'NilaiAnutController@destroy');

Route::post('m_statusPernikahan', 'StatusPernikahanController@store');
Route::delete('m_statusPernikahan/{statusPernikahan}', 'StatusPernikahanController@destroy');

Route::post('m_keluarga', 'KeluargaController@store');
Route::delete('m_keluarga/{keluarga}', 'KeluargaController@destroy');

Route::post('m_tempatTinggal', 'TempatTinggalController@store');
Route::delete('m_tempatTinggal/{tempatTinggal}', 'TempatTinggalController@destroy');

Route::post('m_statusPsikologi', 'StatusPsikologiController@store');
Route::delete('m_statusPsikologi/{statusPsikologi}', 'StatusPsikologiController@destroy');

Route::post('m_hambatanEdukasi', 'HambatanEdukasiController@store');
Route::delete('m_hambatanEdukasi/{hambatanEdukasi}', 'HambatanEdukasiController@destroy');

Route::post('manajemen_form', 'ManajemenFormController@store');
Route::patch('manajemen_form/{manajemenForm}/update', 'ManajemenFormController@update');
Route::post('manajemen_form/{manajemenForm}/delete', 'ManajemenFormController@delete');
