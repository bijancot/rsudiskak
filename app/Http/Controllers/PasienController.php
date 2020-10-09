<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PasienController extends Controller
{
    public function ListPasien(){
        //get data
        $client = new Client();
        $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/215?tglawal=2020-09-21&tglakhir='.date("Y-m-d"));
        $statCode = $res->getStatusCode();
        $datas = $res->getBody()->getContents();
        $datas = json_decode($datas, true);
        $datas = $datas['response'];

        return view('pages.listPasien', compact('datas'));
    }
    public function DataPasien($no_cm){
        //get data
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/'.$no_cm);
        $statCode = $res->getStatusCode();
        $data = $res->getBody()->getContents();
        $data = json_decode($data, true);
        $data = $data['response'];

        return view('pages.dataPasien', compact('data'));
    }

    public function ListPasienKirimPoli(){
        return view('pages.listPasienKirimPoli');
    }

    public function ListPasienHasilLab(){
        return view('pages.listPasienHasilLab');
    }

    public function Riwayat(){
        return view('pages.riwayat');
    }
}
