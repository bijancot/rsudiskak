<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Riwayat;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function riwayatPasien()
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat                = $riwayat->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        return view('pages.riwayatPasien', $data);
    }
    public function print($no_pendaftaran)
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->where('NoPendaftaran',$no_pendaftaran)->get();

        $data = [
            'listRiwayat' => $listriwayat
        ];
        //return $no_pendaftaran;
        //return view('pages.riwayatPasien', $data);
    
    }
}
