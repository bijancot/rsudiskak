<?php

namespace App\Http\Controllers;

use App\ICD09;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ICD09Controller extends Controller
{

    public function getICD09($page = null)
    {

        $client = new Client();
        $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/icd9?page=' . $page);
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

            $item = $this->getICD09($pages);

            foreach ($item['data'] as $row) {
                ICD09::create($row);
            }
            // dump($item['data']);

        }

        return redirect('m_ICD09');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ICD09  $iCD09
     * @return \Illuminate\Http\Response
     */
    public function show(ICD09 $iCD09)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ICD09  $iCD09
     * @return \Illuminate\Http\Response
     */
    public function edit(ICD09 $iCD09)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ICD09  $iCD09
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ICD09 $iCD09)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ICD09  $iCD09
     * @return \Illuminate\Http\Response
     */
    public function destroy(ICD09 $iCD09)
    {
        //
    }
}
