<?php

namespace App\Http\Controllers;

use App\ManajemenForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManajemenFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manajemenForm = ManajemenForm::where([
            ['updated_at', '=', NULL],
            ['deleted_at', '=', NULL],
        ])->get();
        return view('pages.admin.manajemen_form.m_manajemenForm', compact('manajemenForm'));
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
            'namaForm'      => 'required|max:255',
        ]);

        ManajemenForm::create([
            'idForm'        => $request->idForm,
            'namaForm'      => $request->namaForm,
            'namaFile'      => 'pages.admin.manajemen_form.form_dinamis' . $request->namaFile,
            'updated_at'    => NULL,
            'deleted_at'    => NULL,
        ]);

        return redirect('manajemen_form');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ManajemenForm  $manajemenForm
     * @return \Illuminate\Http\Response
     */
    public function show(ManajemenForm $manajemenForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManajemenForm  $manajemenForm
     * @return \Illuminate\Http\Response
     */
    public function edit(ManajemenForm $manajemenForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ManajemenForm  $manajemenForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManajemenForm $manajemenForm)
    {

        $item = ManajemenForm::find($manajemenForm->id);
        $item->updated_at = date("Y-m-d H:i:s");
        $item->save();

        $request->validate([
            'idForm'        => 'required|max:255',
            'namaForm'      => 'required|max:255',
        ]);

        ManajemenForm::create([
            'idForm'            => $request->idForm,
            'namaForm'          => $request->namaForm,
            'namaFile'          => 'pages.admin.manajemen_form.form_dinamis' . $request->namaFile,
            'updated_at'        => NULL,
            'deleted_at'        => NULL,
        ]);

        return redirect('manajemen_form');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManajemenForm  $manajemenForm
     * @return \Illuminate\Http\Response
     */
    public function delete(ManajemenForm $manajemenForm)
    {
        ManajemenForm::where('_id', $manajemenForm->id)
            ->update([
                'deleted_at'    => date("Y-m-d H:i:s"),
            ]);

        return redirect('manajemen_form');
    }
}
