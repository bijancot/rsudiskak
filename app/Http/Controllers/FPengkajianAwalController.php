<?php

namespace App\Http\Controllers;

use App\Agama;
use App\HambatanEdukasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DiagnosaController;
use App\Keluarga;
use App\NilaiAnut;
use App\Pekerjaan;
use App\Pendidikan;
use App\StatusPernikahan;
use App\StatusPsikologi;
use App\TempatTinggal;

class FPengkajianAwalController extends Controller
{
    //
    public function showRajal($NoCM = null)
    {
        if ($NoCM) {

            $diagnosa   = new DiagnosaController;
            $getAntrian = $diagnosa->antrianDataPasien($NoCM);

            $jmlAntrian = collect($getAntrian['data'])->count();
            for ($x = 0; $x < $jmlAntrian; $x++) {

                if ($getAntrian['data'][$x]['NoCM'] == $NoCM) {
                    break;
                }
            }
            $a = $getAntrian['data'][$x];

            $pendidikan         = Pendidikan::where("deleted_at", Null)->get();
            $pekerjaan          = Pekerjaan::where("deleted_at", Null)->get();
            $agama              = Agama::where("deleted_at", Null)->get();
            $nilaiAnut          = NilaiAnut::where("deleted_at", Null)->get();
            $statusPernikahan   = StatusPernikahan::where("deleted_at", Null)->get();
            $keluarga           = Keluarga::where("deleted_at", Null)->get();
            $tempatTinggal      = TempatTinggal::where("deleted_at", Null)->get();
            $statusPsikologi    = StatusPsikologi::where("deleted_at", Null)->get();
            $hambatanEdukasi    = HambatanEdukasi::where("deleted_at", Null)->get();

            $data = [
                'form_id'           => '1',
                'nama_form'         => 'Pengkajian Awal Pasien Rawat Jalan',
                'getDataPasien'     => $a,
                'pendidikan'        => $pendidikan,
                'pekerjaan'         => $pekerjaan,
                'agama'             => $agama,
                'nilaiAnut'         => $nilaiAnut,
                'statusPernikahan'  => $statusPernikahan,
                'keluarga'          => $keluarga,
                'tempatTinggal'     => $tempatTinggal,
                'statusPsikologi'   => $statusPsikologi,
                'hambatanEdukasi'   => $hambatanEdukasi,
            ];

            return view('pages.formPengkajian.pengkajianAwalPasien', $data);
            //endIF

        } else {

            return 'Tidak ada No CM';
        }
    }
}
