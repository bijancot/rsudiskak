<?php

namespace App\Http\Controllers;

use App\Agama;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $agama = Agama::all();
        $agama = Agama::where("deleted_at", Null)->get();
        return view('pages.admin.manajemen_form.m_agama', compact('agama'));
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
        $request->validate([
            'agama'      => 'required|max:255',
        ]);

        Agama::create([
            'agama'         => $request->agama,
            'updated_at'    => NULL,
            'deleted_at'    => NULL,
        ]);

        return redirect('m_agama');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function show(Agama $agama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function edit(Agama $agama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agama $agama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agama $agama)
    {
        // SoftDelete
        // Agama::where('id', $agama->id)
        //     ->update([
        //         'deleted_at' => date("Y-m-d h:i:sa"),
        //     ]);

        // NormalDelete
        Agama::destroy($agama->id);
        return redirect('m_agama');
    }
}
