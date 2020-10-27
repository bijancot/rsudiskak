<?php

namespace App\Http\Controllers;

use App\TempatTinggal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TempatTinggalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tempatTinggal = TempatTinggal::all();
        $tempatTinggal = TempatTinggal::where("deleted_at", Null)->get();
        return view('pages.admin.manajemen_form.m_tempatTinggal', compact('tempatTinggal'));
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
            'tempatTinggal'      => 'required|max:255',
        ]);

        TempatTinggal::create([
            'tempatTinggal'         => $request->tempatTinggal,
            'updated_at'    => NULL,
            'deleted_at'    => NULL,
        ]);

        return redirect('m_tempatTinggal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TempatTinggal  $tempatTinggal
     * @return \Illuminate\Http\Response
     */
    public function show(TempatTinggal $tempatTinggal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TempatTinggal  $tempatTinggal
     * @return \Illuminate\Http\Response
     */
    public function edit(TempatTinggal $tempatTinggal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempatTinggal  $tempatTinggal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TempatTinggal $tempatTinggal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TempatTinggal  $tempatTinggal
     * @return \Illuminate\Http\Response
     */
    public function destroy(TempatTinggal $tempatTinggal)
    {
        // SoftDelete
        // TempatTinggal::where('id', $tempatTinggal->id)
        //     ->update([
        //         'deleted_at' => date("Y-m-d h:i:sa"),
        //     ]);

        // NormalDelete
        TempatTinggal::destroy($tempatTinggal->id);
        return redirect('m_tempatTinggal');
    }
}
