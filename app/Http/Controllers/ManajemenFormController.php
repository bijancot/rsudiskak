<?php

namespace App\Http\Controllers;

use App\ManajemenForm;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
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
            
        $data = [
            'manajemenForm' => $manajemenForm
        ];
        
        return view('pages.admin.manajemen_form.m_manajemenForm', $data);
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
        unset($data['_token']);
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
        
        $data = $request->all();

        if(!empty($request->file('file'))){
            
            // rename file old to edited
            $typeFile = '.blade.php';
            $destinationOld = '../resources/views/' . str_replace('.', '/', $request->get('namaFileOld')) . $typeFile;
            $destinationNew = '../resources/views/pages/formPengkajian/(edited)_' . date('Ymdhis') . '_' . str_replace('pages.formPengkajian.', '', $request->get('namaFileOld')) . $typeFile;
            
            File::move($destinationOld, $destinationNew) ;

            // upload file
            $file = $request->file('file');
            $destination = '../resources/views/pages/formPengkajian';

            $file->move($destination,$file->getClientOriginalName());

            // set new path namefile
            $data['namaFile'] = 'pages.formPengkajian.' . str_replace('.blade.php', '', $file->getClientOriginalName());
            unset($data['file']);

        }
        // update data
        $idFormOld = $request->get('idFormOld');
        unset($data['namaFileOld']);
        unset($data['_method']);
        unset($data['_token']);
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

    public function checkIdDuplicate(Request $req){
        //get data user
        $data = ManajemenForm::where('idForm', $req->get('val'))->whereNotNull('status')->get();
        if(empty($data[0])){
            $res['status'] = false;
            $res['ID'] = null;
        }else{
            $res['status'] = true;
            $res['ID'] = $data[0]['idForm'];
        }

        return response()->json($res);
    }
}
