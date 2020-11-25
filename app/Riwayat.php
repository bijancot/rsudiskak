<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Riwayat extends Eloquent
{
    protected $connection = 'mongodb';
    public $collection;

    // protected $guarded = [];
    protected $fillable = [
        'NoCM', 'NoUrut', 'NoPendaftaran', 'TglMasuk', 'TglMasukPoli', 'jenisPasien', 'Ruangan', 'KdRuangan', 'KdSubInstalasi',
        'StatusPasien', 'KdKelas', 'Kelas', 'StatusPeriksa', 'IdPenjamin', 'IdDokter', 'NamaDokter',
        'KdInstalasi', 'KodeReservasi', 'Status', 'NoIdentitas', 'TglDaftarMembership',
        'Title', 'NamaLengkap', 'TempatLahir', 'TglLahir', 'JenisKelamin', 'Alamat',
        'Telepon', 'NamaIbu', 'Umur', 'UmurTahun', 'UmurBulan', 'UmurHari',
        'Kelurahan', 'Kecamatan', 'Kota', 'NoCmTemp', 'NoCmOld',
        'NamaAyah', 'NoKK', 'NamaSuamiIstri', 'Propinsi', 'RTRW',
        'StatusPengkajian', 'IdFormPengkajian', 'DataPengkajian'
    ];
}
