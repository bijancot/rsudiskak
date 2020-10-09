<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\PasienController;

class DiagnosaController extends Controller
{
    public function DiagnosaAwal(){
        return view('pages.diagnosa');
    }
    public function InsertDiagnosaAwal(){
        $view = new PasienController();
        return $view->ListPasien();
    }

    public function DiagnosaAkhir(){
        return view('pages.diagnosaAkhir');
    }

    public function DataResep(){
        return view('pages.dataResep');
    }

    
}
