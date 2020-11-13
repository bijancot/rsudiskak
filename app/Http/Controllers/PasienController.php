<?php

namespace App\Http\Controllers;

use App\AntrianPasien;
use App\ManajemenForm;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listPasien()
    {
        // //get data
        $client = new Client();
        $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/215?tglawal=2020-09-21&tglakhir=' . date("Y-m-d"));
        $statCode = $res->getStatusCode();
        $antriPoli = $res->getBody()->getContents();
        $antriPoli = json_decode($antriPoli, true);
        $antriPoli = $antriPoli['response'];

        $masukPoli = new AntrianPasien();
        $masukPoli->collection  = "transaksi_" . date("Y-m-d");
        $masukPoli->get();
        $getPasienMasukPoli     = $masukPoli->get();

        if (Auth::user()->Role == "1") {
            $role = "1";
            $ID = Auth::user()->ID;
        } else if (Auth::user()->Role == "2") {
            $ID = Auth::user()->ID;
            $role = "2";
        }

        $diagnosa  = new DiagnosaController();
        $getlistDokter = $diagnosa->listDokter();

        $getForm = ManajemenForm::all();

        $datax = [
            'ID'                => $ID,
            'role'         => $role,
            'datas'             => $antriPoli,
            'masukPoli'         => $getPasienMasukPoli,
            'listDokter'        => $getlistDokter,
            'listForm'          => $getForm,
        ];

        return view('pages.listPasien', $datax);
    }

    public function dataPasien($no_cm)
    {
        //get data
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/' . $no_cm);
        $statCode = $res->getStatusCode();
        $data = $res->getBody()->getContents();
        $data = json_decode($data, true);
        $data = $data['response'];

        return view('pages.dataPasien', compact('data'));
    }

    public function storeBatalPeriksa(Request $request, $no_pendaftaran = null)
    {

        if ($no_pendaftaran) {
            /**
             * Post API Batal Periksa Poliklinik
             */
            $client = new Client();
            $res = $client->request('POST', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/batal', [
                "nopendaftaran"  => $no_pendaftaran,
                "kdruangan"      => "215",
                "keterangan"     => $request->get('keterangan')
            ]);
            $statCode = $res->getStatusCode();
            // dump($statCode);

            return redirect('/listPasien');
            //endIf

        } else {
            "Gagal Melakukan aksi";
        }
    }

    public function ListPasienKirimPoli()
    {
        return view('pages.listPasienKirimPoli');
    }

    public function ListPasienHasilLab()
    {
        return view('pages.listPasienHasilLab');
    }

    public function Riwayat($no_cm)
    {
        if ($no_cm != null) {
            //get data
            $client = new Client();
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/' . $no_cm);
            $statCode = $res->getStatusCode();
            $showPasien = $res->getBody()->getContents();
            $showPasien = json_decode($showPasien, true);
            $showPasien = $showPasien['response'];

            $data = ['data' => $showPasien];
            return view('pages.riwayat', $data);
        } else {
            "No_CM tidak ada";
        }
    }
}
