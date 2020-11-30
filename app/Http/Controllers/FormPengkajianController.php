<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ManajemenForm;
use GuzzleHttp\Client;
use App\ICD10;
use App\ICD09;

class FormPengkajianController extends Controller
{

    // tidak dipakai
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

    // get ICD 09
    public function getICD09(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::collection('ICD09')->select('KodeDiagnosaT', 'DiagnosaTindakan')
                ->where('DiagnosaTindakan', 'LIKE', "%$cari%")
                ->get();
            return response()->json($data);
        }
    }

    // get ICD 10
    public function getICD10(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::collection('ICD10')->select('kodeDiagnosa', 'NamaDiagnosa')
                ->where('NamaDiagnosa', 'LIKE', "%$cari%")
                ->get();
            return response()->json($data);
        }
    }

    /**
     * Simpan pilihan form 
     */
    public function storePilihForm(Request $req, $no_cm, $noPendaftaran)
    {

        // $logging        = new LoggingController;
        date_default_timezone_set('Asia/Jakarta');

        //get data pasien bersarakan nocm
        $dataMasukPoli = DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('TglMasukPoli', $req->get('TglMasukPoli'))
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['IdFormPengkajian' => $req->get('formPengkajian')]);

        DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['IdFormPengkajian' => $req->get('formPengkajian')]);

        // $getForm        = DB::collection('manajemenForm')->where('idForm', $req->get('formPengkajian'))->get();
        // $create_data = $getForm[0]['namaForm'];
        // $logging->toLogging('create', 'PilihForm', $create_data, $no_cm);

        return redirect('formPengkajian/' . $req->get('formPengkajian') . '/' . $no_cm . '/' . $noPendaftaran . '/' . $dataMasukPoli['TglMasukPoli']);
    }

    /**
     * Tampil Halaman Form Pengkajian Dinamis
     */
    public function formPengkajian($idForm, $NoCM, $noPendaftaran, $tglMasukPoli)
    {

        $dataForm = ManajemenForm::where('idForm', $idForm)->get();

        // return view("'".$data[0]['namaFile']."'");
        if ($NoCM && $noPendaftaran) {

            // get data pasien bersarakan nocm
            // $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            //     ->where('NoPendaftaran', $noPendaftaran)
            //     ->where('deleted_at', null)
            //     ->whereNotNull('StatusPengkajian')->get();

            // if ($dataMasukPoli[0]['IdFormPengkajian'] != $idForm) {
            //     return redirect('formPengkajian/' . $dataMasukPoli[0]['IdFormPengkajian'] . '/' . $NoCM . '/' . $noPendaftaran);
            // }

            // get data pasien bersarakan nocm yang masuk poli terakhir
            $dataMasukPoli = DB::collection('pasien_' . $NoCM)
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('TglMasukPoli', $tglMasukPoli)
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->orderBy('created_at', 'desc')
                ->first();

            // dump($dataMasukPoli);

            /**
             * Cek IdFormPengkajian jika idForm pada collection pasien masukPoli 
             * masih kosong atau belum ada (null) atau IdForm tidak sama 
             * maka redirect(arahkan ke halaman) FormPengkajian
             * yang dipilih
             */
            // if ($dataMasukPoli['IdFormPengkajian'] != $idForm) {
            //     return redirect('formPengkajian/' . $dataMasukPoli['IdFormPengkajian'] . '/' . $NoCM . '/' . $noPendaftaran . '/' . $tglMasukPoli);
            // }
            $dataRiwayat        = DB::collection('pasien_' . $NoCM)->whereNotNull('StatusPengkajian')->get();
            $dataDokumen        = DB::collection('dokumen_' . $NoCM)->whereNotNull('Status')->get();
            /**
             * Get Data dari Collection menggunakan Eloquent ORM 
             */
            // $pendidikan         = Pendidikan::where("deleted_at", Null)->get();
            // $pekerjaan          = Pekerjaan::where("deleted_at", Null)->get();
            // $agama              = Agama::where("deleted_at", Null)->get();
            // $nilaiAnut          = NilaiAnut::where("deleted_at", Null)->get();
            // $statusPernikahan   = StatusPernikahan::where("deleted_at", Null)->get();
            // $keluarga           = Keluarga::where("deleted_at", Null)->get();
            // $tempatTinggal      = TempatTinggal::where("deleted_at", Null)->get();
            // $statusPsikologi    = StatusPsikologi::where("deleted_at", Null)->get();
            // $hambatanEdukasi    = HambatanEdukasi::where("deleted_at", Null)->get();

            /**
             * Get Data dari Collection menggunakan Query Builder 
             */
            $pendidikan         = DB::collection('pendidikan')->where("deleted_at", Null)->get();
            $pekerjaan          = DB::collection('pekerjaan')->where("deleted_at", Null)->get();
            $agama              = DB::collection('agama')->where("deleted_at", Null)->get();
            $nilaiAnut          = DB::collection('nilaiAnut')->where("deleted_at", Null)->get();
            $statusPernikahan   = DB::collection('statusPernikahan')->where("deleted_at", Null)->get();
            $keluarga           = DB::collection('keluarga')->where("deleted_at", Null)->get();
            $tempatTinggal      = DB::collection('tempatTinggal')->where("deleted_at", Null)->get();
            $statusPsikologi    = DB::collection('statusPsikologi')->where("deleted_at", Null)->get();
            $hambatanEdukasi    = DB::collection('hambatanEdukasi')->where("deleted_at", Null)->get();

            $diagnosa           = [
                'KodeDiagnosa'  => Null,
                'NamaDiagnosa'  => Null,
            ];

            $diagnosaT          = [
                'KodeDiagnosaT   ' => Null,
                'DiagnosaTindakan' => Null,
            ];

            $ICD10T    = [];
            $ICD10V    = [];
            $ICD09T    = [];
            $ICD09V    = [];

            if (!empty($dataMasukPoli['DataPengkajian'])) {

                if (array_key_exists('Diagnosa', $dataMasukPoli['DataPengkajian']['PengkajianMedis'])) {

                    $diagnosa       = $dataMasukPoli['DataPengkajian']['PengkajianMedis']['Diagnosa'];
                    $pecahKode10    = explode(";", $diagnosa['KodeDiagnosa']);
                    $pecahNama10    = explode(";", $diagnosa['NamaDiagnosa']);
                    // dump($pecahKode10);
                    // dump($pecahNama10);

                    for ($item = 0; $item < count($pecahKode10); $item++) {
                        array_push($ICD10T, $pecahKode10[$item] . " - " . $pecahNama10[$item]);
                        array_push($ICD10V, $pecahKode10[$item] . ":" . $pecahNama10[$item]);
                    }
                    // dump($ICD10T);
                    // dump($ICD10V);
                }

                if (array_key_exists('KodeICD9', $dataMasukPoli['DataPengkajian']['PengkajianMedis'])) {

                    $diagnosaT      = $dataMasukPoli['DataPengkajian']['PengkajianMedis']['KodeICD9'];
                    $pecahKode09    = explode(";", $diagnosaT['KodeDiagnosaT']);
                    $pecahNama09    = explode(";", $diagnosaT['DiagnosaTindakan']);
                    // dump($pecahKode09);
                    // dump($pecahNama09);

                    for ($item = 0; $item < count($pecahKode09); $item++) {
                        array_push($ICD09T, $pecahKode09[$item] . " - " . $pecahNama09[$item]);
                        array_push($ICD09V, $pecahKode09[$item] . ":" . $pecahNama09[$item]);
                    }
                    // dump($ICD09T);
                    // dump($ICD09V);
                }
            }
            // $dataMasukPoli      = DB::collection('pasien_' . $NoCM)
            //     ->where('NoPendaftaran', $noPendaftaran)
            //     ->where('TglMasukPoli', $tglMasukPoli)
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
                'tglMasukPoli'      => $tglMasukPoli,
                'dataRiwayat'       => $dataRiwayat,
                'dataDokumen'       => $dataDokumen,
                'diagnosa'          => $diagnosa,
                'diagnosaT'         => $diagnosaT,
                'ICD10T'            => $ICD10T,
                'ICD10V'            => $ICD10V,
                'ICD09T'            => $ICD09T,
                'ICD09V'            => $ICD09V,
                'dataMasukPoli'     => $dataMasukPoli
            ];
            return view($dataForm[0]['namaFile'], $data);
            //endIF

        } else {

            return 'Halaman yang anda tuju tidak ada';
        }
        // return view('pages.formPengkajian.pengkajianAwalPasien', $no_cm);
    }

    /**
     * Simpan Form Pengkajian
     */
    public function storeFormPengkajian(Request $req, $idForm, $no_cm, $noPendaftaran, $tglMasukPoli)
    {

        $logging        = new LoggingController;
        date_default_timezone_set('Asia/Jakarta');

        //get data pasien bersarakan nocm
        // $dataMasukPoli = DB::collection('pasien_' . $no_cm)->where('NoPendaftaran', $noPendaftaran)->whereNotNull('StatusPengkajian')->get();
        // $dataMasukPoli = $dataMasukPoli[0];

        //get data pasien berdasarkan noPendaftaran dan tanggal terakhir data diinputkan
        $dataMasukPoli = DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('TglMasukPoli', $tglMasukPoli)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        $old = $dataMasukPoli['DataPengkajian'];
        dump($old);
        $old = [];
        $oldKeperawatan = [];
        $oldMedis       = [];
        $oldDiagnosa    = "-";
        $oldICD9        = "-";
        if (array_key_exists('PengkajianKeperawatan', $dataMasukPoli['DataPengkajian'])) {
            $oldKeperawatan = $dataMasukPoli['DataPengkajian']['PengkajianKeperawatan'];
            if (array_key_exists('Diagnosa', $dataMasukPoli['DataPengkajian']['PengkajianMedis'])) {
                $oldDiagnosa = $dataMasukPoli['DataPengkajian']['PengkajianMedis']['Diagnosa']['KodeDiagnosa'];
            }
            if (array_key_exists('KodeICD9', $dataMasukPoli['DataPengkajian']['PengkajianMedis'])) {
                $oldICD9     = $dataMasukPoli['DataPengkajian']['PengkajianMedis']['KodeICD9']['KodeDiagnosaT'];
            }

            $oldMedis       = [
                'Anamnesis'         => $dataMasukPoli['DataPengkajian']['PengkajianMedis']['Anamnesis'],
                'PemeriksaanFisik'  => $dataMasukPoli['DataPengkajian']['PengkajianMedis']['PemeriksaanFisik'],
                'Diagnosa'          => $oldDiagnosa,
                'Komplikasi'        => $dataMasukPoli['DataPengkajian']['PengkajianMedis']['Komplikasi'],
                'Komorbid'          => $dataMasukPoli['DataPengkajian']['PengkajianMedis']['Komorbid'],
                'RencanaDanTerapi'  => $dataMasukPoli['DataPengkajian']['PengkajianMedis']['RencanaDanTerapi'],
                'KodeICD9'          => $oldICD9,
                'Edukasi'           => $dataMasukPoli['DataPengkajian']['PengkajianMedis']['Edukasi'],
                'PenyakitMenular'   => $dataMasukPoli['DataPengkajian']['PengkajianMedis']['PenyakitMenular'],
                'KesanStatusGizi'   => $dataMasukPoli['DataPengkajian']['PengkajianMedis']['KesanStatusGizi'],
            ];
            // dump($oldKeperawatan);
            // dump($oldMedis);
        }
        array_push($old, $oldKeperawatan);
        array_push($old, $oldMedis);
        dump($old);

        // declare data update
        $dataUpdate = $req->all();
        dump($dataUpdate);

        if (array_key_exists('Diagnosa', $dataUpdate['PengkajianMedis'])) {
            // Jika diagnosa terisi
            $ICD10      = $dataUpdate['PengkajianMedis']['Diagnosa'];
            $kode10     = [];
            $nama10     = [];
            // dump($ICD10);

            for ($item = 0; $item < count($ICD10); $item++) {

                $pemisahan[$item] = explode(":", $ICD10[$item]);

                array_push($kode10, $pemisahan[$item][0]);
                array_push($nama10, $pemisahan[$item][1]);
                // dump($kode10);
                // dump($nama10);
            }

            $Jkode10 = implode(";", $kode10);
            $Jnama10 = implode(";", $nama10);

            $diagnosa = [
                'KodeDiagnosa' => $Jkode10,
                'NamaDiagnosa' => $Jnama10,
            ];


            $dataUpdate['PengkajianMedis']['Diagnosa'] = $diagnosa;
            // dump($dataUpdate['PengkajianMedis']['Diagnosa']);
        }

        if (array_key_exists('KodeICD9', $dataUpdate['PengkajianMedis'])) {
            // Jika KodeICD9 terisi
            $ICD09      = $dataUpdate['PengkajianMedis']['KodeICD9'];
            $kode9      = [];
            $nama9      = [];

            for ($item = 0; $item < count($ICD09); $item++) {

                $pemisahan[$item] = explode(":", $ICD09[$item]);

                array_push($kode9, $pemisahan[$item][0]);
                array_push($nama9, $pemisahan[$item][1]);
                // dump($kode9);
                // dump($nama9);

            }

            $Jkode9 = implode(";", $kode9);
            $Jnama9 = implode(";", $nama9);

            $diagnosaT = [
                'KodeDiagnosaT'     => $Jkode9,
                'DiagnosaTindakan'  => $Jnama9,
            ];

            $dataUpdate['PengkajianMedis']['KodeICD9'] = $diagnosaT;
            // dump($dataUpdate['PengkajianMedis']['KodeICD9']);
        }

        // declare status pengkajian
        $statusPengkajian = $dataUpdate['StatusPengkajian'];
        dump($statusPengkajian);
        unset($dataUpdate['_token']);
        unset($dataUpdate['StatusPengkajian']);

        // update data status pengkajian
        DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('TglMasukPoli', $tglMasukPoli)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['StatusPengkajian' => $statusPengkajian]);

        DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('deleted_at', null)
            ->whereIn('StatusPengkajian', ["0", "1", "2"])
            ->update(['StatusPengkajian' => $statusPengkajian]);

        // update data pengkajian
        // berdasarkan no cm
        DB::collection('pasien_' . $no_cm)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('TglMasukPoli', $tglMasukPoli)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['DataPengkajian' => $dataUpdate]);

        // berdasarkan tanggal
        DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['DataPengkajian' => $dataUpdate]);

        // $new = $dataUpdate;
        // dump($new);
        $new = [];
        $newKeperawatan = $dataUpdate['PengkajianKeperawatan'];
        $newDiagnosa    = "-";
        $newICD9        = "-";
        // if (array_key_exists('Diagnosa', $dataMasukPoli['DataPengkajian']['PengkajianMedis'])) {
        //     $newDiagnosa = $dataUpdate['PengkajianMedis']['Diagnosa']['KodeDiagnosa'];
        // }
        // if (array_key_exists('KodeICD9', $dataMasukPoli['DataPengkajian']['PengkajianMedis'])) {
        //     $newICD9     = $dataUpdate['PengkajianMedis']['KodeICD9']['KodeDiagnosaT'];
        // }
        if (array_key_exists('Diagnosa', $dataUpdate)) {
            $newDiagnosa = $dataUpdate['PengkajianMedis']['Diagnosa']['KodeDiagnosa'];
        }
        if (array_key_exists('KodeICD9', $dataUpdate)) {
            $newICD9     = $dataUpdate['PengkajianMedis']['KodeICD9']['KodeDiagnosaT'];
        }
        $newMedis = [
            'Anamnesis'         => $dataUpdate['PengkajianMedis']['Anamnesis'],
            'PemeriksaanFisik'  => $dataUpdate['PengkajianMedis']['PemeriksaanFisik'],
            'Diagnosa'          => $newDiagnosa,
            'Komplikasi'        => $dataUpdate['PengkajianMedis']['Komplikasi'],
            'Komorbid'          => $dataUpdate['PengkajianMedis']['Komorbid'],
            'RencanaDanTerapi'  => $dataUpdate['PengkajianMedis']['RencanaDanTerapi'],
            'KodeICD9'          => $newICD9,
            'Edukasi'           => $dataUpdate['PengkajianMedis']['Edukasi'],
            'PenyakitMenular'   => $dataUpdate['PengkajianMedis']['PenyakitMenular'],
            'KesanStatusGizi'   => $dataUpdate['PengkajianMedis']['KesanStatusGizi'],
        ];
        // dump($newKeperawatan);
        // dump($newMedis);
        array_push($new, $newKeperawatan);
        array_push($new, $newMedis);
        dump($new);

        /**
         * $data_old untuk mencari perbedaan atau perubahan data lama 
         * $data_cur untuk mencari perbedaan atau perubahan data baru 
         */
        $data_oldKeperawatan    = array_diff_assoc($old[0], $new[0]);
        $data_oldMedis          = array_diff_assoc($old[1], $new[1]);
        $data_curKeperawatan    = array_diff_assoc($new[0], $old[0]);
        $data_curMedis          = array_diff_assoc($new[1], $old[1]);
        // dump($data_oldKeperawatan);
        // dump($data_oldMedis);
        // dump($data_curKeperawatan);
        // dump($data_curMedis);

        if ((count($data_oldKeperawatan) != 0 || count($data_curKeperawatan) != 0) && count($data_curMedis) == 0) {
            // echo "yang ke 1";
            $updateData = [
                'old'       => $data_oldKeperawatan,
                'current'   => $data_curKeperawatan,
            ];
            // dump($updateData);
        } else if ((count($data_oldMedis) != 0 || count($data_curMedis) != 0) && count($data_curKeperawatan) == 0) {
            // echo "yang ke 2";
            $updateData = [
                'old'       => $data_oldMedis,
                'current'   => $data_curMedis,
            ];
            // dump($updateData);
        } else if (count($data_curKeperawatan) != 0 && count($data_curMedis) != 0) {
            // echo "yang ke 3";
            $lama = [
                'PengkajianKeperawatan' => $data_oldKeperawatan,
                'PengkajianMedis'       => $data_oldMedis,
            ];
            $baru = [
                'PengkajianKeperawatan' => $data_curKeperawatan,
                'PengkajianMedis'       => $data_curMedis,
            ];
            $updateData = [
                'old'       => $lama,
                'current'   => $baru,
            ];
            // dump($updateData);
        } else {
            // echo "Tidak ada";
            $updateData = 'Tidak ada perubahan';
        }


        if ($dataMasukPoli['StatusPengkajian'] == "0") {
            // Logging belum Verifikasi 
            $logging->toLogging('save', 'FormPengkajian', 'Isi Form Pengkajian', $no_cm);
            //
        } else if ($statusPengkajian == "1") {
            // Logging belum Verifikasi 
            // $logging->toLogging('save', 'FormPengkajian', 'Isi Form Pengkajian', $no_cm);

            $logging->toLogging('update', 'FormPengkajian', $updateData, $no_cm);
            //

        } else if ($statusPengkajian == "2") {

            $logging->toLogging('final', 'FormPengkajian', $updateData, $no_cm);

            // if (array_key_exists('verifikasi', $dataMasukPoli['DataPengkajian'])) {
            //     $logging->toLogging('final', 'FormPengkajian', $updateData, $no_cm);
            // } 
            // else {
            //     $logging->toLogging('update', 'FormPengkajian', $updateData, $no_cm);
            // }
        }

        // return redirect('formPengkajian/' . $idForm . '/' . $no_cm . '/' . $noPendaftaran . '/' . $tglMasukPoli);

        /**
         *  Deprecated
         */
        //------------------------------------------------------------------------------------//
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
        // if ($isLastSubForm == "1") {
        //     $statusPengkajian = "2";
        // }
        // /**
        //  * Jika SubForm masih belum diisi secara lengkap (masih 1 subForm yang terisi) 
        //  * dan StatusPengkajian bukan bernilai 2 (belum selesai) 
        //  * maka StatusPengkajian bernilai 1 (periksa)
        //  */
        // else if ($isLastSubForm == "0" && $dataMasukPoli["StatusPengkajian"] != 2) {
        //     $statusPengkajian = "1";
        // } else {
        //     $statusPengkajian = "2";
        // }

        // check status update data
        /**
         * Jika statusUpdate = 0, maka data akan dipush atau tambah 
         * Jika statusUpdate = 1, maka data akan diupdate
         * $index untuk mengetahui subForm saat ini
         */

        // $statusUpdate = 0;
        // $index = 0;

        /**
         * Get DataPengkajian sesuai Data Pasien Masuk Poli
         * dan lakukan cek subFrom telah terisi atau belum
         * $subForm berisi PengkajianKeperawatan_1
         * atau PengkajianKeperawatan_2
         */
        // foreach ($dataMasukPoli['DataPengkajian'] as $item) {

        //     if (!empty($item[$subForm])) {
        //         $statusUpdate = 1;
        //         break;
        //     }
        //     $index++;
        // }

        // // update data status pengkajian
        // DB::collection('pasien_' . $no_cm)
        //     ->where('NoPendaftaran', $noPendaftaran)
        //     ->where('deleted_at', null)
        //     ->whereNotNull('StatusPengkajian')
        //     ->update(['StatusPengkajian' => $statusPengkajian]);

        // DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
        //     ->where('NoPendaftaran', $noPendaftaran)
        //     ->where('deleted_at', null)
        //     ->whereIn('StatusPengkajian', ["0", "1", "2", "3"])
        //     ->update(['StatusPengkajian' => $statusPengkajian]);

        // // push / update data pengkajian
        // if ($statusUpdate == 0) {
        //     // berdasarkan no cm
        //     DB::collection('pasien_' . $no_cm)
        //         ->where('NoPendaftaran', $noPendaftaran)
        //         ->where('deleted_at', null)
        //         ->whereNotNull('StatusPengkajian')
        //         ->push('DataPengkajian', $req->all(), true);

        //     // berdasarkan tanggal
        //     DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
        //         ->where('NoPendaftaran', $noPendaftaran)
        //         ->where('deleted_at', null)
        //         ->whereNotNull('StatusPengkajian')
        //         ->push('DataPengkajian', $req->all(), true);

        //     // $pushData = $req->all();
        //     $pushData = "Buat Data Pengkajian No. Pendaftaran '" . $noPendaftaran . "' dengan mengisi data form " . $subForm;
        //     $logging->toLogging('create', 'DataPengkajian', $pushData, $no_cm);
        //     //

        // } else if ($statusUpdate == 1) {

        //     // get DataPengkajian lama sesuai dengan subForm yang ditentukan
        //     $old = $dataMasukPoli['DataPengkajian'][$index][$subForm];

        //     // berdasarkan no cm
        //     DB::collection('pasien_' . $no_cm)
        //         ->where('NoPendaftaran', $noPendaftaran)
        //         ->where('deleted_at', null)
        //         ->whereNotNull('StatusPengkajian')
        //         ->update(['DataPengkajian.' . $index => $req->all()]);

        //     // berdasarkan tanggal
        //     DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
        //         ->where('NoPendaftaran', $noPendaftaran)
        //         ->where('deleted_at', null)
        //         ->whereNotNull('StatusPengkajian')
        //         ->update(['DataPengkajian.' . $index => $req->all()]);

        //     /**
        //      * Get dataMasukPoli baru
        //      */
        //     $dataMasukPoli = DB::collection('pasien_' . $no_cm)
        //         ->where('NoPendaftaran', $noPendaftaran)
        //         ->where('deleted_at', null)
        //         ->whereNotNull('StatusPengkajian')
        //         ->orderBy('created_at', 'desc')
        //         ->first();
        //     // get DataPengkajian baru sesuai dengan subForm yang ditentukan
        //     $new = $dataMasukPoli['DataPengkajian'][$index][$subForm];

        //     /**
        //      * $data_old untuk mencari perbedaan atau perubahan data lama 
        //      * $data_cur untuk mencari perbedaan atau perubahan data baru 
        //      */
        //     $data_old = array_diff_assoc($old, $new);
        //     $data_cur = array_diff_assoc($new, $old);
        //     $updateData = [
        //         'old'       => $data_old,
        //         'current'   => $data_cur,
        //     ];
        //     $logging->toLogging('update', 'DataPengkajian', $updateData, $no_cm);
        // }
        // -------------------------------------------------------------------------------------//
    }

    /**
     * Batal Form Pengkajian
     */
    public function storeBatalForm(Request $req)
    {

        date_default_timezone_set('Asia/Jakarta');

        $logging        = new LoggingController;

        //get data pasien bersarakan nocm
        // $dataMasukPoli = DB::collection('pasien_' . $req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->whereNotNull('StatusPengkajian')->get();
        // $dataMasukPoli = $dataMasukPoli[0];
        $dataMasukPoli = DB::collection('pasien_' . $req->get('NoCM'))
            ->where('NoPendaftaran', $req->get('NoPendaftaran'))
            ->where('TglMasukPoli', $req->get('TglMasukPoli'))
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        //edit data
        DB::collection('pasien_' . $req->get('NoCM'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->where('TglMasukPoli', $req->get('TglMasukPoli'))->where('deleted_at', null)->update(['StatusPengkajian' => null]);
        DB::collection('transaksi_' . date('Y-m-d'))->where('NoPendaftaran', $req->get('NoPendaftaran'))->where('TglMasukPoli', $req->get('TglMasukPoli'))->where('deleted_at', null)->update(['StatusPengkajian' => null]);

        //reset variable
        unset($dataMasukPoli['_id']);
        $dataMasukPoli['StatusPengkajian'] = "0";
        $dataMasukPoli['IdFormPengkajian'] = "";
        $dataMasukPoli['DataPengkajian'] = array();

        //insert data baru
        DB::collection('pasien_' . $req->get('NoCM'))->insertGetId($dataMasukPoli);
        DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])->insert($dataMasukPoli);

        $logging->toLogging('batal', 'PilihForm', $req->get('NoPendaftaran'), $req->get('NoCM'));

        return redirect('/listPasien');
    }
}
