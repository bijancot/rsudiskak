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
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff

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

<<<<<<< HEAD
    public function storePilihForm(Request $req, $no_cm, $noPendaftaran)
    {
        //get data pasien bersarakan nocm
        $dataMasukPoli = DB::collection('pasien_' . $no_cm)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();

        DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->whereNotNull('StatusPengkajian')
            ->update(['IdFormPengkajian' => $req->get('formPengkajian')]);

        DB::collection('transaksi_' . $dataMasukPoli[0]["TglMasukPoli"])
            ->where('NoPendaftaran', $noPendaftaran)
            ->whereNotNull('StatusPengkajian')
            ->update(['IdFormPengkajian' => $req->get('formPengkajian')]);

        return redirect('formPengkajian/' . $req->get('formPengkajian') . '/' . $no_cm . '/' . $noPendaftaran);
    }

=======
    /**
     * Simpan pilihan form 
     */
    public function storePilihForm(Request $req, $no_cm, $noPendaftaran)
    {
        $getIDuser      = Auth::user()->ID;
        $getNamaUser    = Auth::user()->Nama;
        $getRole        = Auth::user()->Role;
        $getKdRuangan   = Auth::user()->KodeRuangan;

        $logging        = new LoggingController;

        //get data pasien bersarakan nocm
        $dataMasukPoli = DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['IdFormPengkajian' => $req->get('formPengkajian')]);

        DB::collection('transaksi_' . $dataMasukPoli["TglMasukPoli"])
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['IdFormPengkajian' => $req->get('formPengkajian')]);

        $getForm        = DB::collection('manajemenForm')->where('idForm', $req->get('formPengkajian'))->get();

        $create_data = $getForm[0]['namaForm'];

        $logging->toLogging($getIDuser, $getNamaUser, $getRole, 'create', 'PilihForm', $create_data, $no_cm, $getKdRuangan);

        return redirect('formPengkajian/' . $req->get('formPengkajian') . '/' . $no_cm . '/' . $noPendaftaran);
    }

    /**
     * Tampil Halaman Form Pengkajian Dinamis
     */
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
    public function formPengkajian($idForm, $NoCM, $noPendaftaran)
    {

        $dataForm = ManajemenForm::where('idForm', $idForm)->get();
        // return view("'".$data[0]['namaFile']."'");
        if ($NoCM && $noPendaftaran) {
            //get data pasien bersarakan nocm
<<<<<<< HEAD
            $dataMasukPoli = DB::collection('pasien_' . $NoCM)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();
=======
            $dataMasukPoli = DB::collection('pasien_' . $NoCM)->where('NoPendaftaran', $noPendaftaran)->where('deleted_at', null)->whereNotNull('StatusPengkajian')->get();
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
            if ($dataMasukPoli[0]['IdFormPengkajian'] != $idForm) {
                return redirect('formPengkajian/' . $dataMasukPoli[0]['IdFormPengkajian'] . '/' . $NoCM . '/' . $noPendaftaran);
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
<<<<<<< HEAD
            $dataMasukPoli      = DB::collection('pasien_' . $NoCM)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();
=======
            $dataMasukPoli      = DB::collection('pasien_' . $NoCM)->where('NoPendaftaran', $noPendaftaran)->where('deleted_at', null)->whereNotNull('StatusPengkajian')->get();
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff

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

<<<<<<< HEAD
    public function storeFormPengkajian(Request $req, $idForm, $no_cm, $noPendaftaran, $subForm, $isLastSubForm)
    {
        //get data pasien bersarakan nocm
        $dataMasukPoli = DB::collection('pasien_' . $no_cm)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();

        //check status pengkajian
        if ($isLastSubForm == "1") {
            $statusPengkajian = "2";
        } else if ($isLastSubForm == "0" && $dataMasukPoli[0]["StatusPengkajian"] != 2) {
=======
    /**
     * Simpan Form Pengkajian
     */
    public function storeFormPengkajian(Request $req, $idForm, $no_cm, $noPendaftaran, $subForm, $isLastSubForm)
    {

        $getIDuser      = Auth::user()->ID;
        $getNamaUser    = Auth::user()->Nama;
        $getRole        = Auth::user()->Role;
        $getKdRuangan   = Auth::user()->KodeRuangan;

        $logging        = new LoggingController;

        //get data pasien bersarakan nocm
        // $dataMasukPoli = DB::collection('pasien_' . $no_cm)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();
        // $dataMasukPoli = $dataMasukPoli[0];

        //get data pasien berdasarkan noPendaftaran dan tanggal terakhir data diinputkan
        $dataMasukPoli = DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        /**
         * check status pengkajian jika
         * 0 belum terisi, 
         * 1 periksa, 
         * 2 selesai, 
         * null batal 
         */

        /**
         * Jika SubForm terakhir telah diisi, maka statusPengkajian berubah menjadi 2 (selesai)
         */
        if ($isLastSubForm == "1") {
            $statusPengkajian = "2";
        }
        /**
         * Jika SubForm masih belum diisi secara lengkap (masih 1 subForm yang terisi) 
         * dan StatusPengkajian bukan bernilai 2 (belum selesai) 
         * maka StatusPengkajian bernilai 1 (periksa)
         */
        else if ($isLastSubForm == "0" && $dataMasukPoli["StatusPengkajian"] != 2) {
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
            $statusPengkajian = "1";
        } else {
            $statusPengkajian = "2";
        }

        // check status update data
<<<<<<< HEAD
        $statusUpdate = 0;
        $index = 0;
        foreach ($dataMasukPoli[0]['DataPengkajian'] as $item) {
=======
        /**
         * Jika statusUpdate = 0, maka data akan dipush atau tambah 
         * Jika statusUpdate = 1, maka data akan diupdate
         * $index untuk mengetahui subForm saat ini
         */
        $statusUpdate = 0;
        $index = 0;

        /**
         * Get DataPengkajian sesuai Data Pasien Masuk Poli
         * dan lakukan cek subFrom telah terisi atau belum
         * $subForm berisi PengkajianKeperawatan_1
         * atau PengkajianKeperawatan_2
         */
        foreach ($dataMasukPoli['DataPengkajian'] as $item) {

>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
            if (!empty($item[$subForm])) {
                $statusUpdate = 1;
                break;
            }
            $index++;
        }

        // update data status pengkajian
        DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
<<<<<<< HEAD
            ->whereNotNull('StatusPengkajian')
            ->update(['StatusPengkajian' => $statusPengkajian]);

        DB::collection('transaksi_' . $dataMasukPoli[0]['TglMasukPoli'])
            ->where('NoPendaftaran', $noPendaftaran)
=======
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['StatusPengkajian' => $statusPengkajian]);

        DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('deleted_at', null)
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
            ->whereIn('StatusPengkajian', ["0", "1", "2", "3"])
            ->update(['StatusPengkajian' => $statusPengkajian]);

        // push / update data pengkajian
        if ($statusUpdate == 0) {
            // berdasarkan no cm
            DB::collection('pasien_' . $no_cm)
                ->where('NoPendaftaran', $noPendaftaran)
<<<<<<< HEAD
=======
                ->where('deleted_at', null)
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
                ->whereNotNull('StatusPengkajian')
                ->push('DataPengkajian', $req->all(), true);

            // berdasarkan tanggal
<<<<<<< HEAD
            DB::collection('transaksi_' . $dataMasukPoli[0]['TglMasukPoli'])
                ->where('NoPendaftaran', $noPendaftaran)
                ->whereNotNull('StatusPengkajian')
                ->push('DataPengkajian', $req->all(), true);
        } else if ($statusUpdate == 1) {
            // berdasarkan no cm
            DB::collection('pasien_' . $no_cm)
                ->where('NoPendaftaran', $noPendaftaran)
=======
            DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->push('DataPengkajian', $req->all(), true);

            // $pushData = $req->all();
            $pushData = "Buat Data Pengkajian No. Pendaftaran '" . $noPendaftaran . "' dengan mengisi data form " . $subForm;
            $logging->toLogging($getIDuser, $getNamaUser, $getRole, 'create', 'DataPengkajian', $pushData, $no_cm, $getKdRuangan);
            //

        } else if ($statusUpdate == 1) {

            // get DataPengkajian lama sesuai dengan subForm yang ditentukan
            $old = $dataMasukPoli['DataPengkajian'][$index][$subForm];

            // berdasarkan no cm
            DB::collection('pasien_' . $no_cm)
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('deleted_at', null)
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
                ->whereNotNull('StatusPengkajian')
                ->update(['DataPengkajian.' . $index => $req->all()]);

            // berdasarkan tanggal
<<<<<<< HEAD
            DB::collection('transaksi_' . $dataMasukPoli[0]['TglMasukPoli'])
                ->where('NoPendaftaran', $noPendaftaran)
                ->whereNotNull('StatusPengkajian')
                ->update(['DataPengkajian.' . $index => $req->all()]);
=======
            DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['DataPengkajian.' . $index => $req->all()]);

            /**
             * Get dataMasukPoli baru
             */
            $dataMasukPoli = DB::collection('pasien_' . $no_cm)
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->orderBy('created_at', 'desc')
                ->first();
            // get DataPengkajian baru sesuai dengan subForm yang ditentukan
            $new = $dataMasukPoli['DataPengkajian'][$index][$subForm];

            /**
             * $data_old untuk mencari perbedaan atau perubahan data lama 
             * $data_cur untuk mencari perbedaan atau perubahan data baru 
             */
            $data_old = array_diff_assoc($old, $new);
            $data_cur = array_diff_assoc($new, $old);
            $updateData = [
                'old'       => $data_old,
                'current'   => $data_cur,
            ];
            $logging->toLogging($getIDuser, $getNamaUser, $getRole, 'update', 'DataPengkajian', $updateData, $no_cm, $getKdRuangan);
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
        }

        return redirect('formPengkajian/' . $idForm . '/' . $no_cm . '/' . $noPendaftaran);
    }
<<<<<<< HEAD
    public function storeBatalForm(Request $req)
    {
        //get data pasien bersarakan nocm
        $dataMasukPoli = DB::collection('pasien_' . $req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->whereNotNull('StatusPengkajian')->get();
        $dataMasukPoli = $dataMasukPoli[0];

        //edit data
        DB::collection('pasien_' . $req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->update(['StatusPengkajian' => null]);
        DB::collection('transaksi_' . date('Y-m-d'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->update(['StatusPengkajian' => null]);
=======

    /**
     * Batal Form Pengkajian
     */
    public function storeBatalForm(Request $req)
    {
        $getIDuser      = Auth::user()->ID;
        $getNamaUser    = Auth::user()->Nama;
        $getRole        = Auth::user()->Role;
        $getKdRuangan   = Auth::user()->KodeRuangan;

        $logging        = new LoggingController;

        //get data pasien bersarakan nocm
        // $dataMasukPoli = DB::collection('pasien_' . $req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->whereNotNull('StatusPengkajian')->get();
        // $dataMasukPoli = $dataMasukPoli[0];
        $dataMasukPoli = DB::collection('pasien_' . $req->get('NoCM'))
            ->where('NoPendaftaran', $req->get('NoPendaftaran'))
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        //edit data
        DB::collection('pasien_' . $req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->where('deleted_at', null)->update(['StatusPengkajian' => null]);
        DB::collection('transaksi_' . date('Y-m-d'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->where('deleted_at', null)->update(['StatusPengkajian' => null]);
>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff

        //reset variable
        unset($dataMasukPoli['_id']);
        $dataMasukPoli['StatusPengkajian'] = "0";
        $dataMasukPoli['IdFormPengkajian'] = "";
        $dataMasukPoli['DataPengkajian'] = array();

        //insert data baru
        DB::collection('pasien_' . $req->get('NoCM'))->insertGetId($dataMasukPoli);
        DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])->insert($dataMasukPoli);

<<<<<<< HEAD
=======
        $logging->toLogging($getIDuser, $getNamaUser, $getRole, 'batal', 'PilihForm', $req->get('NoPendaftaran'), $req->get('NoCM'), $getKdRuangan);

>>>>>>> 38b21e69fe83e5926d025e27f5757c21d8781bff
        return redirect('/listPasien');
    }
}
