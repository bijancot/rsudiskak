<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FPengkajianUlangController extends Controller
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

            $data = [
                'form_id'           => '2',
                'nama_form'         => 'Pengkajian Ulang Pasien Rawat Jalan',
                'getDataPasien'     => $a,
            ];

            return view('pages.formPengkajian.pengkajianUlangPasien', $data);
            //endIF

        } else {

            return 'Tidak ada No CM';
        }
    }
}
