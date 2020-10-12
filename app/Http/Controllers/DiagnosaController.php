<?php

namespace App\Http\Controllers;

use App\AntrianPasien;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\PasienController;

class DiagnosaController extends Controller
{
    public function diagnosaAwal($no_cm = null)
    {
        if ($no_cm != null) {

            //get data
            $client = new Client();
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/' . $no_cm);
            $statCode = $res->getStatusCode();
            $showPasien = $res->getBody()->getContents();
            $showPasien = json_decode($showPasien, true);
            $showPasien = $showPasien['response'];

            $data = [
                'no_cm'     => $no_cm,
                'data'      => $showPasien,
            ];
            return view('pages.diagnosa', $data);
            // return redirect('pages.diagnosa', $data);
            // endif

        } else {
            "No_CM tidak ada";
        }
    }

    public function storeDiagnosaAwal($no_cm = null)
    {
        $view = new PasienController();
        return $view->listPasien();
    }

    public function diagnosaAkhir($no_cm = null)
    {
        if ($no_cm != null) {

            $data = [
                'no_cm' => $no_cm
            ];
            dump($data);
            // return redirect('pages.diagnosa', $data);
            //endif

        } else {
            "No_CM tidak ada";
        }
        return view('pages.diagnosaAkhir');
    }

    public function dataResep()
    {
        return view('pages.dataResep');
    }

    public function pilihDokter($no_cm = null)
    {

        if ($no_cm != null) {

            // $subNavbar = '<a class="capsule-btn active" style="border-radius: 24px 24px 24px 24px;" href="#">Pilih Dokter</a>';
            $getDokter = $this->listDokter();
            $data = [
                'listDokter'    => $getDokter,
                'no_cm'         => $no_cm,
                // 'subNavbar'     => $subNavbar
            ];
            return view('pages.pilihDokter', $data);
            //endif

        } else {
            "No_CM tidak ada";
        }
    }

    public function storePilihDokter(Request $request)
    {
        $antrianPasien_noCM = new AntrianPasien();
        $antrianPasien_noCM->collection = "pasien_" . $request->get('no_cm');
        $antrianPasien_noCM->dokter = $request->get('dokter');
        $antrianPasien_noCM->no_cm  = $request->get('no_cm');
        $antrianPasien_noCM->updated_at = null;
        $antrianPasien_noCM->deleted_at = null;
        $antrianPasien_noCM->save();

        $antrianPasien_tgl = new AntrianPasien();
        $antrianPasien_tgl->collection = "pasien_" . date("Y-m-d");
        $antrianPasien_tgl->dokter = $request->get('dokter');
        $antrianPasien_tgl->no_cm  = $request->get('no_cm');
        $antrianPasien_tgl->updated_at = null;
        $antrianPasien_tgl->deleted_at = null;
        $antrianPasien_tgl->save();

        return redirect('/listPasien');
    }

    public function listDokter()
    {
        //get data
        $client = new Client();
        $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/listdokter/L009222710?page=1');
        $statCode = $res->getStatusCode();
        $datas = $res->getBody()->getContents();
        $datas = json_decode($datas, true);
        $datas = $datas['response'];

        return $datas;
    }
}
