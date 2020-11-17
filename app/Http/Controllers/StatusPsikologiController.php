<?php

namespace App\Http\Controllers;

use App\StatusPsikologi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusPsikologiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $statusPsikologi = StatusPsikologi::all();
        $statusPsikologi = StatusPsikologi::where("deleted_at", Null)->get();
        return view('pages.admin.manajemen_form.m_statusPsikologi', compact('statusPsikologi'));
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
            'statusPsikologi'      => 'required|max:255',
        ]);

        StatusPsikologi::create([
            'statusPsikologi'         => $request->statusPsikologi,
            'updated_at'    => NULL,
            'deleted_at'    => NULL,
        ]);

        return redirect('m_statusPsikologi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StatusPsikologi  $statusPsikologi
     * @return \Illuminate\Http\Response
     */
    public function show(StatusPsikologi $statusPsikologi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StatusPsikologi  $statusPsikologi
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusPsikologi $statusPsikologi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusPsikologi  $statusPsikologi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusPsikologi $statusPsikologi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusPsikologi  $statusPsikologi
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusPsikologi $statusPsikologi)
    {
        // SoftDelete
        // StatusPsikologi::where('id', $statusPsikologi->id)
        //     ->update([
        //         'deleted_at' => date("Y-m-d h:i:sa"),
        //     ]);

        // NormalDelete
        StatusPsikologi::destroy($statusPsikologi->id);
        return redirect('m_statusPsikologi');
    }
}
