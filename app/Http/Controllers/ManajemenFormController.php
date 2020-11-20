<?php

namespace App\Http\Controllers;

use App\ManajemenForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

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
            ['status', '!=', NULL],
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
        $file = $request->file('file');

        $destination = '../resources/views/pages/formPengkajian';
        $file->move($destination,$file->getClientOriginalName());
        
        $request->validate([
            'namaForm'      => 'required|max:255',
        ]);
        
        // insert data
        $data = $request->all();
        unset($data['file']);
        $data['namaFile'] = 'pages.formPengkajian.' . str_replace('.blade.php', '', $file->getClientOriginalName());

        ManajemenForm::insert($data);

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
        
        // rename file
        $destination = '../resources/views/pages/formPengkajian/';
        $typeFile = '.blade.php';
        
        File::move($destination . $request->get('namaFileOld') . $typeFile, $destination.$request->get('namaFile'). $typeFile) ;
        
        // update data
        $data = $request->all();
        $idFormOld = $request->get('idFormOld');
        $data['namaFile'] = 'pages.formPengkajian.'.$data['namaFile'];
        unset($data['namaFileOld']);
        unset($data['_method']);
        unset($data['idFormOld']);

        ManajemenForm::where('idForm', $idFormOld)->whereNotNull('status')->update($data);

        return redirect('manajemen_form');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManajemenForm  $manajemenForm
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, ManajemenForm $manajemenForm)
    {
        // rename file
        $destination = '../resources/views/pages/formPengkajian/';
        $typeFile = '.blade.php';
        
        File::move($destination . $request->get('namaFile') . $typeFile, $destination.'(deleted)_'. date('Ymdhis') . $request->get('namaFile') . $typeFile);
        
        ManajemenForm::where('_id', $manajemenForm->id)
            ->update([
                'status'    => null,
            ]);
        
        return redirect('manajemen_form');
    }
}
