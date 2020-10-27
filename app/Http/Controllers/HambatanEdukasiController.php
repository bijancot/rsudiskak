<?php

namespace App\Http\Controllers;

use App\HambatanEdukasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HambatanEdukasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $hambatanEdukasi = HambatanEdukasi::all();
        $hambatanEdukasi = HambatanEdukasi::where("deleted_at", Null)->get();
        return view('pages.admin.manajemen_form.m_hambatanEdukasi', compact('hambatanEdukasi'));
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
            'hambatanEdukasi'      => 'required|max:255',
        ]);

        HambatanEdukasi::create([
            'hambatanEdukasi'         => $request->hambatanEdukasi,
            'updated_at'    => NULL,
            'deleted_at'    => NULL,
        ]);

        return redirect('m_hambatanEdukasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HambatanEdukasi  $hambatanEdukasi
     * @return \Illuminate\Http\Response
     */
    public function show(HambatanEdukasi $hambatanEdukasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HambatanEdukasi  $hambatanEdukasi
     * @return \Illuminate\Http\Response
     */
    public function edit(HambatanEdukasi $hambatanEdukasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HambatanEdukasi  $hambatanEdukasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HambatanEdukasi $hambatanEdukasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HambatanEdukasi  $hambatanEdukasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(HambatanEdukasi $hambatanEdukasi)
    {
        // SoftDelete
        // HambatanEdukasi::where('id', $hambatanEdukasi->id)
        //     ->update([
        //         'deleted_at' => date("Y-m-d h:i:sa"),
        //     ]);

        // NormalDelete
        HambatanEdukasi::destroy($hambatanEdukasi->id);
        return redirect('m_hambatanEdukasi');
    }
}
