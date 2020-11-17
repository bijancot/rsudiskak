<?php

namespace App\Http\Controllers;

use App\NilaiAnut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NilaiAnutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $nilaiAnut = NilaiAnut::all();
        $nilaiAnut = NilaiAnut::where("deleted_at", Null)->get();
        return view('pages.admin.manajemen_form.m_nilaiAnut', compact('nilaiAnut'));
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
            'nilaiAnut'      => 'required|max:255',
        ]);

        NilaiAnut::create([
            'nilaiAnut'         => $request->nilaiAnut,
            'updated_at'    => NULL,
            'deleted_at'    => NULL,
        ]);

        return redirect('m_nilaiAnut');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NilaiAnut  $nilaiAnut
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiAnut $nilaiAnut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NilaiAnut  $nilaiAnut
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiAnut $nilaiAnut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NilaiAnut  $nilaiAnut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiAnut $nilaiAnut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NilaiAnut  $nilaiAnut
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiAnut $nilaiAnut)
    {
        // SoftDelete
        // NilaiAnut::where('id', $nilaiAnut->id)
        //     ->update([
        //         'deleted_at' => date("Y-m-d h:i:sa"),
        //     ]);

        // NormalDelete
        NilaiAnut::destroy($nilaiAnut->id);
        return redirect('m_nilaiAnut');
    }
}
