<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Riwayat;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\ManajemenForm;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function riwayatPasien()
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat                = $riwayat->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        return view('pages.riwayatPasien', $data);
    }
    public function historicalList()
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat                = $riwayat->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        return view('pages.admin.historicalList', $data);
    }
    public function printRiwayatAwal($no_pendaftaran)
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->where('NoPendaftaran', $no_pendaftaran)->where('IdFormPengkajian', '1')->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        //return view('pages.print.listRiwayat_print', $data);
        $pdf = PDF::loadview('pages.print.listRiwayatAwal_print', $data);
        $pdf->setPaper('legal', 'potrait');
        return $pdf->stream("listRiwayatAwal_$no_pendaftaran.pdf", array("Attachment" => false));
    }
    public function printRiwayatUlang($no_pendaftaran)
    {
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->where('NoPendaftaran', $no_pendaftaran)->where('IdFormPengkajian', '2')->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        // return $no_pendaftaran;
        //return view('pages.print.listRiwayat_print', $data);
        $pdf = PDF::loadview('pages.print.listRiwayatUlang_print', $data);
        $pdf->setPaper('legal', 'potrait');
        return $pdf->stream("listRiwayatUlang_$no_pendaftaran.pdf", array("Attachment" => false));
    }

    public function printProfilRingkas($idForm, $NoCM, $noPendaftaran, $tglMasukPoli)
    {
        $dataForm = ManajemenForm::where('idForm', $idForm)->get();

        // return view("'".$data[0]['namaFile']."'");
        if ($NoCM && $noPendaftaran) {

            $dataMasukPoli = DB::collection('pasien_' . $NoCM)
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('TglMasukPoli', $tglMasukPoli)
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->orderBy('created_at', 'desc')
                ->first();

            /**
             * Cek IdFormPengkajian jika idForm pada collection pasien masukPoli 
             * masih kosong atau belum ada (null) atau IdForm tidak sama 
             * maka redirect(arahkan ke halaman) FormPengkajian
             * yang dipilih
             */
            if ($dataMasukPoli['IdFormPengkajian'] != $idForm) {
                return redirect('formPengkajian/' . $dataMasukPoli['IdFormPengkajian'] . '/' . $NoCM . '/' . $noPendaftaran);
            }
            $dataRiwayat        = DB::collection('pasien_' . $NoCM)->whereNotNull('StatusPengkajian')->get();
            $dataDokumen        = DB::collection('dokumen_' . $NoCM)->whereNotNull('Status')->get();

            $pendidikan         = DB::collection('pendidikan')->where("deleted_at", Null)->get();
            $pekerjaan          = DB::collection('pekerjaan')->where("deleted_at", Null)->get();
            $agama              = DB::collection('agama')->where("deleted_at", Null)->get();
            $nilaiAnut          = DB::collection('nilaiAnut')->where("deleted_at", Null)->get();
            $statusPernikahan   = DB::collection('statusPernikahan')->where("deleted_at", Null)->get();
            $keluarga           = DB::collection('keluarga')->where("deleted_at", Null)->get();
            $tempatTinggal      = DB::collection('tempatTinggal')->where("deleted_at", Null)->get();
            $statusPsikologi    = DB::collection('statusPsikologi')->where("deleted_at", Null)->get();
            $hambatanEdukasi    = DB::collection('hambatanEdukasi')->where("deleted_at", Null)->get();

            // $dataMasukPoli      = DB::collection('pasien_' . $NoCM)
            //     ->where('NoPendaftaran', $noPendaftaran)
            //     ->where('deleted_at', null)
            //     ->whereNotNull('StatusPengkajian')
            //     ->orderBy('created_at', 'desc')
            //     ->first();

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
                'dataRiwayat'       => $dataRiwayat,
                'dataDokumen'       => $dataDokumen,
                'dataMasukPoli'     => $dataMasukPoli
            ];
            // dump($dataMasukPoli['DataPengkajian']);
            // dump($dataMasukPoli);
            $pdf = PDF::loadview('pages.print.profilRingkas_print', $data);
            $pdf->setPaper('legal', 'potrait');
            return $pdf->stream("profilRingkas_$noPendaftaran.pdf", array("Attachment" => false));
        }
    }
}
