<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Riwayat;
use Illuminate\Support\Facades\Auth;
use PDF;

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
    public function printRiwayat($no_pendaftaran)
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->where('NoPendaftaran',$no_pendaftaran)->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        //return view('pages.print.listRiwayat_print', $data);
        $pdf = PDF::loadview('pages.print.listRiwayat_print',$data);
        
        return $pdf->stream("listRiwayat_$no_pendaftaran.pdf", array("Attachment" => false));
        
    }
}
