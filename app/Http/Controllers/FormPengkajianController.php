<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ManajemenForm;
use App\AntrianPasien;
use App\Http\Controllers\DiagnosaController;
use App\Keluarga;
use App\NilaiAnut;
use App\Pekerjaan;
use App\Pendidikan;
use App\StatusPernikahan;
use App\StatusPsikologi;
use App\TempatTinggal;
use App\Agama;
use App\HambatanEdukasi;

class FormPengkajianController extends Controller
{
    public function pilihForm($no_cm = null, $noPendaftaran = null)
    {
        if ($no_cm != null && $noPendaftaran) {

            $getForm = ManajemenForm::all();
            $data = [
                'listForm'        => $getForm,
                'no_cm'           => $no_cm,
                'noPendaftaran'   => $noPendaftaran
            ];
            return view('pages.pilihForm', $data);
            //endif

        } else {
            "No_CM tidak ada";
        }
    }

    public function storePilihForm(Request $req, $no_cm, $noPendaftaran){
        DB::collection('pasien_'.$no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->whereNotNull('StatusPengkajian')
            ->update(['IdFormPengkajian' => $req->get('formPengkajian')]);

        DB::collection('transaksi_'.date('Y-m-d'))
            ->where('NoPendaftaran', $noPendaftaran)
            ->whereNotNull('StatusPengkajian')
            ->update(['IdFormPengkajian' => $req->get('formPengkajian')]);

        return redirect('formPengkajian/'.$req->get('formPengkajian').'/'.$no_cm.'/'.$noPendaftaran);
    }

    public function formPengkajian($idForm, $NoCM, $noPendaftaran){

        $dataForm = ManajemenForm::where('idForm', $idForm)->get();
        // return view("'".$data[0]['namaFile']."'");
        if ($NoCM && $noPendaftaran) {
            //get data pasien bersarakan nocm
            $dataMasukPoli = DB::collection('pasien_'.$NoCM)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();    
            if($dataMasukPoli[0]['IdFormPengkajian'] != $idForm){
                return redirect('formPengkajian/'.$dataMasukPoli[0]['IdFormPengkajian'].'/'.$NoCM.'/'.$noPendaftaran);     
            }

            $pendidikan         = Pendidikan::where("deleted_at", Null)->get();
            $pekerjaan          = Pekerjaan::where("deleted_at", Null)->get();
            $agama              = Agama::where("deleted_at", Null)->get();
            $nilaiAnut          = NilaiAnut::where("deleted_at", Null)->get();
            $statusPernikahan   = StatusPernikahan::where("deleted_at", Null)->get();
            $keluarga           = Keluarga::where("deleted_at", Null)->get();
            $tempatTinggal      = TempatTinggal::where("deleted_at", Null)->get();
            $statusPsikologi    = StatusPsikologi::where("deleted_at", Null)->get();
            $hambatanEdukasi    = HambatanEdukasi::where("deleted_at", Null)->get();
            $dataMasukPoli      = DB::collection('pasien_'.$NoCM)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();

            $data = [
                'form_id'           => $idForm,
                'nama_form'         => $dataForm[0]['namaForm'],
                'pendidikan'        => $pendidikan,
                'pekerjaan'         => $pekerjaan,
                'agama'             => $agama,
                'nilaiAnut'         => $nilaiAnut,
                'statusPernikahan'  => $statusPernikahan,
                'keluarga'          => $keluarga,
                'tempatTinggal'     => $tempatTinggal,
                'statusPsikologi'   => $statusPsikologi,
                'hambatanEdukasi'   => $hambatanEdukasi,
                'idForm'            => $idForm,
                'NoCM'              => $NoCM,
                'noPendaftaran'     => $noPendaftaran,
                'dataMasukPoli'     => $dataMasukPoli[0]
            ];
            return view($dataForm[0]['namaFile'], $data);
            //endIF

        } else {

            return 'Halaman yang anda tuju tidak ada';
        }
        // return view('pages.formPengkajian.pengkajianAwalPasien', $no_cm);
    }

    public function storeFormPengkajian(Request $req, $idForm, $no_cm, $noPendaftaran, $subForm, $isLastSubForm){
        //get data pasien bersarakan nocm
        $dataMasukPoli = DB::collection('pasien_'.$no_cm)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();
        
        //check status pengkajian
        if($isLastSubForm == "1"){
            $statusPengkajian = "2";
        }else if($isLastSubForm == "0" && $dataMasukPoli[0]["StatusPengkajian"] != 2){
            $statusPengkajian = "1";
        }else{
            $statusPengkajian = "2";
        }

        // check status update data
        $statusUpdate = 0;
        $index = 0;
        foreach($dataMasukPoli[0]['DataPengkajian'] as $item){
            if(!empty($item[$subForm])){
                $statusUpdate = 1;
                break;
            }
            $index++;
        }

        // update data status pengkajian
        DB::collection('pasien_'.$no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->whereNotNull('StatusPengkajian')
            ->update(['StatusPengkajian' => $statusPengkajian]);
            
        DB::collection('transaksi_'.date('Y-m-d'))
            ->where('NoPendaftaran', $noPendaftaran)
            ->whereIn('StatusPengkajian', ["0", "1", "2", "3"])
            ->update(['StatusPengkajian' => $statusPengkajian]);
            
        // push / update data pengkajian
        if($statusUpdate == 0){
            // berdasarkan no cm
            DB::collection('pasien_'.$no_cm)
                ->where('NoPendaftaran', $noPendaftaran)
                ->whereNotNull('StatusPengkajian')
                ->push('DataPengkajian', $req->all(), true);
                
            // berdasarkan tanggal
            DB::collection('transaksi_'.date('Y-m-d'))
                ->where('NoPendaftaran', $noPendaftaran)
                ->whereNotNull('StatusPengkajian')
                ->push('DataPengkajian', $req->all(), true);
        }else if($statusUpdate == 1){
            // berdasarkan no cm
            DB::collection('pasien_'.$no_cm)
                ->where('NoPendaftaran', $noPendaftaran)
                ->whereNotNull('StatusPengkajian')
                ->update(['DataPengkajian.'.$index => $req->all()]);
                
            // berdasarkan tanggal
            DB::collection('transaksi_'.date('Y-m-d'))
                ->where('NoPedaftaran', $noPendaftaran)
                ->whereNotNull('StatusPengkajian')
                ->update(['DataPengkajian.'.$index => $req->all()]);
        }

        return redirect('formPengkajian/'.$idForm.'/'.$no_cm.'/'.$noPendaftaran);
    }
    public function storeBatalForm(Request $req){
        //get data pasien bersarakan nocm
        $dataMasukPoli = DB::collection('pasien_'.$req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->whereNotNull('StatusPengkajian')->get();
        $dataMasukPoli = $dataMasukPoli[0];
        
        //edit data
        DB::collection('pasien_'.$req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->update(['StatusPengkajian' => null]);
        DB::collection('transaksi_'.date('Y-m-d'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->update(['StatusPengkajian' => null]);

        //reset variable
        unset($dataMasukPoli['_id']);
        $dataMasukPoli['StatusPengkajian'] = "0";
        $dataMasukPoli['IdFormPengkajian'] = "";
        $dataMasukPoli['DataPengkajian'] = array();
        
        //insert data baru
        DB::collection('pasien_'.$req->get('NoCM'))->insertGetId($dataMasukPoli);
        DB::collection('transaksi_'.date('Y-m-d'))->insert($dataMasukPoli);

        return redirect('/listPasien');
    }
}
