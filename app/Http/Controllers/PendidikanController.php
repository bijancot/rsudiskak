<?php

namespace App\Http\Controllers;

use App\Pendidikan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pendidikan = Pendidikan::all();

        $pendidikan = Pendidikan::where("deleted_at", Null)->get();
        return view('pages.admin.manajemen_form.m_pendidikan', compact('pendidikan'));
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
            'pendidikan'      => 'required|max:255',
        ]);

        Pendidikan::create([
            'pendidikan'  => $request->pendidikan,
            'updated_at'  => NULL,
            'deleted_at'  => NULL,
        ]);

        return redirect('m_pendidikan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pendidikan  $pendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendidikan $pendidikan)
    {
        // SoftDelete
        // Pendidikan::where('id', $pendidikan->id)
        //     ->update([
        //         'deleted_at' => date("Y-m-d h:i:sa"),
        //     ]);

        // NormalDelete
        Pendidikan::destroy($pendidikan->id);
        return redirect('m_pendidikan');
    }
}
