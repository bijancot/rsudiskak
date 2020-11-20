<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use File;

class DokumenController extends Controller
{
    public function index(){
        //get data kdruangan from api
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ');
        $statCode = $res->getStatusCode();
        $kdRuangan = $res->getBody()->getContents();
        $kdRuangan = json_decode($kdRuangan, true);
        $kdRuangan = $kdRuangan['data'];

        // get data dokumen
        $dataDokumen = array();
        $index = 0;
        foreach(\DB::connection()->getMongoDB()->listCollections() as $collection){
            // check collection with name dokumen_
            $pos = strpos($collection->getName(), 'dokumen_');
            if($pos !== false){
                $dataDokumen[$index] = DB::collection($collection->getName())->whereNotNull('Status')->get();
                $index++;
            }
        }
        
        $data = [
            'kdRuangan' => $kdRuangan,
            'dataDokumen' => $dataDokumen
        ];

        return view('pages.admin.dokumen', $data);
    }
    public function store(Request $req){
        // declare filepath
        $file = $req->file('file');
        $destination = 'dokumenRM/'.$req->get('NoCM');

        // upload data
        $file->move($destination, $req->get('NoPendaftaran').'_'.$req->get('TanggalMasuk').'_'.$file->getClientOriginalName());
        
        //get data kdruangan from api
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ');
        $statCode = $res->getStatusCode();
        $kdRuangan = $res->getBody()->getContents();
        $kdRuangan = json_decode($kdRuangan, true);
        $kdRuangan = $kdRuangan['data'];

        // insert data
        $data = $req->all();
        unset($data['file']);
        $data['NamaFile'] = $destination."/".$data['NoPendaftaran'].'_'.$req->get('TanggalMasuk').'_'.$file->getClientOriginalName();
        
        //insert nama ruangan
        $data['NamaRuangan'] = "";
        foreach ($kdRuangan as $item) {
            if ($item['KdRuangan'] == $req->get('KodeRuangan')) {
                $data['NamaRuangan'] = $item['NamaRuangan'];
                break;
            }
        }
        
        DB::collection('dokumen_'.$data['NoCM'])->insert($data);
        
        return redirect('dokumen');
    }
    public function update(Request $req){
        // declare filepath
        $destinationOld = 'dokumenRM/'.$req->get('NoCMOld');
        $destinationNew = 'dokumenRM/'.$req->get('NoCM');
        
        // update file path
        File::move($destinationOld.'/'.$req->get('NoPendaftaranOld').'_'.$req->get('NamaFileOld').'.pdf', $destinationNew.'/'.$req->get('NoPendaftaran').'_'.$req->get('NamaFile').'.pdf');
        
        // update data
        $data = $req->all();
        unset($data['NoPendaftaranOld']);
        unset($data['NoCMOld']);
        unset($data['NamaFileOld']);
        $data['NamaFile'] = $destinationNew."/".$data['NoPendaftaran'].'_'.$data['NamaFile'].'.php';
        
        //update nama ruangan
        $data['NamaRuangan'] = "";
        foreach ($kdRuangan as $item) {
            if ($item['KdRuangan'] == $req->get('KodeRuangan')) {
                $data['NamaRuangan'] = $item['NamaRuangan'];
            break;
            }
        }
        
        DB::collection('dokumen_'.$data['NoCM'])->where('NoPendaftaran', $req->get('NoPendaftaranOld'))->update($data);
        return redirect('dokumen');
    }
    
    public function delete(Request $req){
        date_default_timezone_set('UTC');
        // declare filepath
        $destination = 'dokumenRM/'.$req->get('NoCM');
        $deleteDate = date('Ymdhis');
        $namaFileOld = $destination.'/'.$req->get('NoPendaftaran').'_'.$req->get('TanggalMasuk').'_'.$req->get('NamaFile').'.pdf';
        $namaFileNew = $destination.'/(deleted)_'.$req->get('NoPendaftaran').'_'.$req->get('TanggalMasuk').'_'.$req->get('NamaFile').'pdf';

        //move to deleted directory
        File::move($namaFileOld, $namaFileNew);
        
        // delete data
        DB::collection('dokumen_'.$req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->update(['Status' => null, 'NamaFile' => $namaFileNew]);
        return redirect('dokumen');
    }

    public function getData(Request $req){
        $data = DB::collection('dokumen_'.$req->get('noCm'))->where('NoPendaftaran', $req->get('noPendaftaran'))->whereNotNull('Status')->get();
        if(!empty($data[0])){
            $data = $data[0];
            $data['FullPath'] = asset($data['NamaFile']);
            $data['PathFile'] = $data['NamaFile'];
            $data['NamaFile'] = str_replace('dokumenRM/'.$data['NoCM'].'/'.$data['NoPendaftaran'].'_'.$data['TanggalMasuk'].'_', '', $data['NamaFile']);
            $data['NamaFile'] = str_replace('.pdf', '', $data['NamaFile']);
        }else{
            "Data Tidak Ditemukan";
        }

        return response()->json($data);
    }
    public function download(Request $req){
        return response()->download(public_path().'/'.$req->get('PathFile'));
    }

    public function berkas($no_cm){
        //get data kdruangan from api
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ');
        $statCode = $res->getStatusCode();
        $kdRuangan = $res->getBody()->getContents();
        $kdRuangan = json_decode($kdRuangan, true);
        $kdRuangan = $kdRuangan['data'];

        // get data dokumen
        $dataDokumen = array();
        $index = 0;
        foreach(\DB::connection()->getMongoDB()->listCollections() as $collection){
            // check collection with name dokumen_
            $pos = strpos($collection->getName(), 'dokumen_');
            if($pos !== false){
                $dataDokumen[$index] = DB::collection($collection->getName())->whereNotNull('Status')->get();
                $index++;
            }
        }
        $dataDokumen = DB::collection('dokumen_'.$no_cm)->whereNotNull('Status')->get();
        
        $data = [
            'kdRuangan' => $kdRuangan,
            'dataDokumen' => $dataDokumen,
            'no_cm' => $no_cm
        ];

        return view('pages.berkas', $data);
    }
}
