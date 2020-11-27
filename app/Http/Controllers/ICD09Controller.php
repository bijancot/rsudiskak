<?php

namespace App\Http\Controllers;

use App\ICD09;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class ICD09Controller extends Controller
{

    public function setICD09()
    {
        // $cookieTime = 1;

        // $data = ICD09::all();
        // dump($data);
        // foreach ($data as $item) {
        //     // $item['KodeDiagnosaT'];
        //     dump($item['KodeDiagnosaT']);
        // }
        // $data       = [
        //     'kodeDiagnosa' => "A0009",
        //     'NamaDiagnosa' => "Salo"
        // ];
        // $json = serialize($data);
        // $json = json_encode($data);
        // dump($json);
        // $response->withCookie(cookie('ICD9',  $json, $cookieTime));
        // dump($response);
        // return response(redirect('/listPasien'))->cookie(
        //     'ICD9',
        //     $json,
        //     $cookieTime
        // );
    }

    public function getICD09(Request $request)
    {
        $value = $request->cookie('ICD9');
        return $value;
    }

    public function getAPIICD09($page = null)
    {

        // $client = new Client();
        // $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/icd9?page=' . $page);
        // $statCode = $res->getStatusCode();
        // $data = $res->getBody()->getContents();
        // $data = json_decode($data, true);
        // $data = $data['response'];
        // return $data;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iCD09  = ICD09::all();
        $data   = [
            'iCD09' => $iCD09
        ];
        // dump($iCD10);
        return view('pages.admin.listICD09', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for ($pages = 151; $pages <= 192; $pages++) {

            $item = $this->getAPIICD09($pages);

            foreach ($item['data'] as $row) {
                ICD09::create($row);
            }
            // dump($item['data']);

        }

        return redirect('m_ICD09');
    }
}
