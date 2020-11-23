<?php

namespace App\Http\Controllers;

use App\ICD10;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ICD10Controller extends Controller
{

    public function getICD10($page = null)
    {

        $client = new Client();
        $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/icd10?page=' . $page);
        $statCode = $res->getStatusCode();
        $data = $res->getBody()->getContents();
        $data = json_decode($data, true);
        $data = $data['response'];

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // for ($i = 1; $i <= 100; $i++) {
        //     $getData = $this->getICD10($i);

        //     dump($getData['current_page']);
        //     dump($getData['data']);
        // }

        // for ($pages = 1; $pages <= 2; $pages++) {

        //     $item = $this->getICD10($pages);

        //     foreach ($item['data'] as $row) {
        //         dump($row);
        //     }
        //     // dump($item['data']);

        // }
        // dump($iCD10);
        $iCD10  = ICD10::all();
        $data   = [
            'iCD10' => $iCD10
        ];
        // dump($iCD10);
        return view('pages.admin.listICD10', $data);
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
        // for ($i = 1; $i <= 2; $i++) {
        //     $item = $this->getICD10($i);
        //     // array_merge($iCD10, $item['data']);
        //     // dump($item['data']);
        // }
        // ICD10::create($item['data']);
        // 681
        // for ($pages = 681; $pages <= 707; $pages++) {

        //     $item = $this->getICD10($pages);

        //     foreach ($item['data'] as $row) {
        //         ICD10::create($row);
        //     }
        //     // dump($item['data']);

        // }

        return redirect('m_ICD10');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ICD10  $iCD10
     * @return \Illuminate\Http\Response
     */
    public function show(ICD10 $iCD10)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ICD10  $iCD10
     * @return \Illuminate\Http\Response
     */
    public function edit(ICD10 $iCD10)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ICD10  $iCD10
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ICD10 $iCD10)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ICD10  $iCD10
     * @return \Illuminate\Http\Response
     */
    public function destroy(ICD10 $iCD10)
    {
        //
    }
}
