<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index(){
        return view('pages.admin.uploadFile');
    }
    public function store(Request $req){
        $file = $req->file('file');

        $destination = '../resources/views/pages/formPengkajian';
        $file->move($destination,$file->getClientOriginalName());
        return redirect('uploadFile');
    }
}
