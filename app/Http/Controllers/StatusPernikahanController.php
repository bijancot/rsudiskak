<?php

namespace App\Http\Controllers;

use App\StatusPernikahan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusPernikahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $statusPernikahan = StatusPernikahan::all();
        $statusPernikahan = StatusPernikahan::where("deleted_at", Null)->get();
        return view('pages.admin.manajemen_form.m_statusPernikahan', compact('statusPernikahan'));
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
            'statusPernikahan'      => 'required|max:255',
        ]);

        StatusPernikahan::create([
            'statusPernikahan'         => $request->statusPernikahan,
            'updated_at'    => NULL,
            'deleted_at'    => NULL,
        ]);

        return redirect('m_statusPernikahan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StatusPernikahan  $statusPernikahan
     * @return \Illuminate\Http\Response
     */
    public function show(StatusPernikahan $statusPernikahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StatusPernikahan  $statusPernikahan
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusPernikahan $statusPernikahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusPernikahan  $statusPernikahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusPernikahan $statusPernikahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusPernikahan  $statusPernikahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusPernikahan $statusPernikahan)
    {
        // SoftDelete
        // StatusPernikahan::where('id', $statusPernikahan->id)
        //     ->update([
        //         'deleted_at' => date("Y-m-d h:i:sa"),
        //     ]);

        // NormalDelete
        StatusPernikahan::destroy($statusPernikahan->id);
        return redirect('m_statusPernikahan');
    }
}
