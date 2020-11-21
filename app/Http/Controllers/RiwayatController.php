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
    public function printRiwayatAwal($no_pendaftaran)
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->where('NoPendaftaran',$no_pendaftaran)->where('IdFormPengkajian','1')->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        //return view('pages.print.listRiwayat_print', $data);
        $pdf = PDF::loadview('pages.print.listRiwayatAwal_print',$data);
        $pdf->setPaper('legal', 'potrait');
        return $pdf->stream("listRiwayatAwal_$no_pendaftaran.pdf", array("Attachment" => false));
        
    }
    public function printRiwayatUlang($no_pendaftaran)
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->where('NoPendaftaran',$no_pendaftaran)->where('IdFormPengkajian','2')->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        // return $no_pendaftaran;
        //return view('pages.print.listRiwayat_print', $data);
        $pdf = PDF::loadview('pages.print.listRiwayatUlang_print',$data);
        $pdf->setPaper('legal', 'potrait');
        return $pdf->stream("listRiwayatUlang_$no_pendaftaran.pdf", array("Attachment" => false));
        
    }

    public function printProfilRingkas($no_pendaftaran)
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->where('NoPendaftaran',$no_pendaftaran)->where('IdFormPengkajian','2')->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        // return $no_pendaftaran;
        //return view('pages.print.listRiwayat_print', $data);
        $pdf = PDF::loadview('pages.print.profilRingkas_print',$data);
        $pdf->setPaper('legal', 'potrait');
        return $pdf->stream("profilRingkas_$no_pendaftaran.pdf", array("Attachment" => false));
        
    }
}
