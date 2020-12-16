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
        for($i = 1; $i <=2; $i++){
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ?page='.$i);
            $statCode = $res->getStatusCode();
            $kdRuangan = $res->getBody()->getContents();
            $kdRuangan = json_decode($kdRuangan, true);

            $resKdRuangan[$i-1] = $kdRuangan['data'];
        }

        // get data dokumen
        $dataDokumen = array();
        $index = 0;
        $listDokumen = DB::collection('listDokumen')->get();
        foreach($listDokumen as $item){
            $dataDokumen[$index] = DB::collection('dokumen_'.$item['NoCM'])->whereNotNull('Status')->get();
            $index++;
        }

        // $dataDokumen = array();
        // $index = 0;
        // foreach(\DB::connection()->getMongoDB()->listCollections() as $collection){
        //     // check collection with name dokumen_
        //     $pos = strpos($collection->getName(), 'dokumen_');
        //     if($pos !== false){
        //         $dataDokumen[$index] = DB::collection($collection->getName())->whereNotNull('Status')->get();
        //         $index++;
        //     }
        // }
        
        $data = [
            'kdRuangan' => $resKdRuangan,
            'dataDokumen' => $dataDokumen
        ];

        return view('pages.admin.dokumen', $data);
    }
    public function store(Request $req){

        // declare filepath
        $file = $req->file('file');
        $destination = 'dokumenRM/'.$req->get('NoCM');

        // upload data
        $file->move($destination, $req->get('NoPendaftaran').'_'.$req->get('TanggalMasuk').'.pdf');
        
        //get data kdruangan from api
        $client = new Client();
        for($i = 1; $i <=2; $i++){
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ?page='.$i);
            $statCode = $res->getStatusCode();
            $kdRuangan = $res->getBody()->getContents();
            $kdRuangan = json_decode($kdRuangan, true);

            $resKdRuangan[$i-1] = $kdRuangan['data'];
        }

        // register nocm into listDokumen
        $data = $req->all();
        unset($data['_token']);

        $statusData = DB::collection('listDokumen')->where('NoCM', $data['NoCM'])->get();

        if(empty($statusData[0])){
            DB::collection('listDokumen')->insert(['NoCM' => $data['NoCM'], 'NamaLengkap' => $data['NamaLengkap']]);
        }

        // check if redirect to formpengkajian
        $redirectPage = '';
        if(!empty($data['urlPengkajian'])){
            $redirectPage = $data['urlPengkajian'];
            unset($data['urlPengkajian']);
        }else{
            $redirectPage = 'dokumen';
        }

        // insert data into db dokumen_
        unset($data['file']);
        $data['NamaFile'] = $destination."/".$data['NoPendaftaran'].'_'.$req->get('TanggalMasuk').'.pdf';
        
        //insert nama ruangan
        $data['NamaRuangan'] = "";
        foreach ($resKdRuangan as $index) {
            foreach($index as $item){
                if ($item['KdRuangan'] == $req->get('KodeRuangan')) {
                    $data['NamaRuangan'] = $item['NamaRuangan'];
                    break;
                }
            }
        }

        DB::collection('dokumen_'.$data['NoCM'])->insert($data);

        // assignment redirect
        if($redirectPage == 'dokumen'){
            return redirect($redirectPage)->with('isCreate', true);
        }else{
            return redirect($redirectPage)->with('isUploadDokumen', true);
        }
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
        $namaFileOld = $destination.'/'.$req->get('NoPendaftaran').'_'.$req->get('TanggalMasuk').'.pdf';
        $namaFileNew = $destination.'/(deleted at '.$deleteDate.' )_'.$req->get('NoPendaftaran').'_'.$req->get('TanggalMasuk').'pdf';

        //move to deleted directory
        File::move($namaFileOld, $namaFileNew);
        
        // delete data
        DB::collection('dokumen_'.$req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->update(['Status' => null, 'NamaFile' => $namaFileNew]);
        return redirect('dokumen')->with('isDelete', true);
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

    public function checkIdDuplicate(Request $req){
        //get data no pendaftaran
        $data = DB::collection('dokumen_'.$req->get('noCm'))->get();
        if(!empty($data[0])){
            $dataDokumen = DB::collection('dokumen_'.$req->get('noCm'))->where('NoPendaftaran', $req->get('noPendaftaran'))->whereNotNull('Status')->get();
            if(!empty($dataDokumen[0])){
                $res['status'] = true;
                $res['ID'] = $req->get('noPendaftaran');
                return response()->json($res);
            }
        }
        
        $res['status'] = false;
        $res['ID'] = null;
        return response()->json($res);
    }
    public function checkNoCmIsNull(Request $req){
         //get data noCm
        $data = DB::collection('pasien_'.$req->get('noCm'))->get();
        if(empty($data[0])){
            $res['status'] = true;
            $res['ID'] = null;
            $res['NamaLengkap'] = null;
        }else{
            $res['status'] = false;
            $res['ID'] = $data[0]['NoCM'];
            $res['NamaLengkap'] = $data[0]['NamaLengkap'];
         }

        return response()->json($res);
    }
}
