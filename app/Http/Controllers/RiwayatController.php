<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Riwayat;
use Illuminate\Support\Facades\Auth;
use PDF;
use File;
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
        date_default_timezone_set('Asia/Jakarta');
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->whereNotNull('StatusPengkajian')->where('StatusPengkajian', '2')->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        return view('pages.riwayatPasien', $data);
    }

    public function getData(Request $req)
    {
        date_default_timezone_set('Asia/Jakarta');
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . $req->get('date');
        $listriwayat            = $riwayat->whereNotNull('StatusPengkajian')->where('StatusPengkajian', '2')->get();
        $html = "";
        $action = "";
        $ver = "";
        $lihatForm = "";
        foreach ($listriwayat as $data) {
            $lihatForm = "<a href='lihatFormPengkajian/" . $data['IdFormPengkajian'] . "/" . $data['NoCM'] . "/" . $data['NoPendaftaran'] . "/" . $data['TglMasukPoli'] . "' class='btn btn-primary'><i class='fas fa-eye'></i> Lihat Form</a>";
            $action = "<a href='printRiwayat/" . $data['IdFormPengkajian'] . "/" . $data['NoCM'] . "/" . $data['NoPendaftaran'] . "/" . $data['TglMasukPoli'] . "' target='_blank' class='btn diagnosa'><i class='fas fa-print'></i> Print</a>";
            if (Auth::user()->Role == '003') {
                $ver = "<a href='#' data-toggle='modal' data-target='#modal_hapus' data-nopendaftaran='" . $data['NoPendaftaran'] . "' data-nocm='" . $data['NoCM'] . "' data-tanggal='" . $data['TglMasukPoli'] . "' class='btn hapus-data batal'>Batal Verifikasi</a>";
            }

            $html .= "
            
            <tr>
                <td> " . $data['NoPendaftaran'] . "</td>
                <td> " . $data['NoCM'] . "</td>
                <td> " . $data['NamaLengkap'] . "</td>
                <td> " . $data['TglMasukPoli'] . "</td>
                <td data-label='Action' class='d-flex flex-row p-lg-1'>
                " . $lihatForm . "" . $action . "" . $ver . "
                </td>
            </tr>";
        }

        $data = [
            'html' => $html
        ];

        return response()->json($data);
    }

    public function printRiwayat($idForm, $NoCM, $noPendaftaran, $tglMasukPoli)
    {
        date_default_timezone_set('Asia/Jakarta');
        $dataForm = ManajemenForm::where('idForm', $idForm)->get();
        // return view("'".$data[0]['namaFile']."'");
        if ($NoCM && $noPendaftaran) {

            $listriwayat = DB::collection('pasien_' . $NoCM)
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
            if ($listriwayat['IdFormPengkajian'] != $idForm) {
                return redirect('formPengkajian/' . $listriwayat['IdFormPengkajian'] . '/' . $NoCM . '/' . $noPendaftaran);
            }
            $dataRiwayat        = DB::collection('pasien_' . $NoCM)->whereNotNull('StatusPengkajian')->get();
            $dataRiwayatDetail        = DB::collection('pasien_' . $NoCM)->whereNotNull('StatusPengkajian')->where('IdFormPengkajian', '1')->first();
            $dataRiwayatAlergi        = DB::collection('pasien_' . $NoCM)->whereNotNull('StatusPengkajian')->where('IdFormPengkajian', '1')->get();

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
                'dataRiwayatDetail' => $dataRiwayatDetail,
                'dataRiwayatAlergi' => $dataRiwayatAlergi,
                'dataDokumen'       => $dataDokumen,
                'listRiwayat'       => $listriwayat
            ];
            $dataF = $dataForm[0]['namaFile'] . 'Print';
            $dataZ = str_replace("formPengkajian", "print", $dataF);
            // return view($dataZ, $data);

            $pdf = PDF::loadview($dataZ, $data);
            $pdf->setPaper('legal', 'potrait');
            return $pdf->stream("listRiwayat.pdf", array("Attachment" => false));
        }
    }

    public function historicalList()
    {
        date_default_timezone_set('Asia/Jakarta');
        $riwayat = new Riwayat();
        $riwayat->collection    = "transaksi_" . date("Y-m-d");
        $listriwayat            = $riwayat->whereNotNull('StatusPengkajian')->where('StatusPengkajian', '2')->get();
        $data = [
            'listRiwayat' => $listriwayat
        ];
        // dump($listriwayat);
        return view('pages.admin.historicalList', $data);
    }

    public function printProfilRingkas($idForm, $NoCM, $noPendaftaran, $tglMasukPoli)
    {
        date_default_timezone_set('Asia/Jakarta');
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
            $dataRiwayatDetail        = DB::collection('pasien_' . $NoCM)->whereNotNull('StatusPengkajian')->where('IdFormPengkajian', '1')->first();
            $dataRiwayatAlergi        = DB::collection('pasien_' . $NoCM)->whereNotNull('StatusPengkajian')->where('IdFormPengkajian', '1')->get();

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
                'dataRiwayatDetail' => $dataRiwayatDetail,
                'dataRiwayatAlergi' => $dataRiwayatAlergi,
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

    public function batalVerifikasi(Request $req)
    {
        date_default_timezone_set('Asia/Jakarta');

        // //edit data
        DB::collection('pasien_' . $req->get('NoCM'))
            ->where('NoPendaftaran', $req->get('NoPendaftaran'))
            ->where('TglMasukPoli', $req->get('TglMasukPoli'))
            ->where('deleted_at', null)->update(['StatusPengkajian' => '1']);
        DB::collection('transaksi_' . $req->get('TglMasukPoli'))
            ->where('NoCM', $req->get('NoCM'))
            ->where('NoPendaftaran', $req->get('NoPendaftaran'))
            ->where('TglMasukPoli', $req->get('TglMasukPoli'))
            ->where('deleted_at', null)
            ->update(['StatusPengkajian' => '1']);
        // print($req->get('NoPendaftaran'));
        // print('<br>');
        // print($req->get('NoCM'));
        // print('<br>');
        // print($req->get('TglMasukPoli'));

        $file_path = public_path('dokumenRM/' . $req->get('NoCM') . '/' . $req->get('NoPendaftaran') . '_' . $req->get('TglMasukPoli') . '.pdf');
        File::delete($file_path);

        return redirect('/historicalList');
    }

    public function formPengkajian($idForm, $NoCM, $noPendaftaran, $tglMasukPoli)
    {

        $dataForm = ManajemenForm::where('idForm', $idForm)->get();

        if ($NoCM && $noPendaftaran) {

            $dataMasukPoli = DB::collection('pasien_' . $NoCM)
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('TglMasukPoli', $tglMasukPoli)
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->orderBy('created_at', 'desc')
                ->first();

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

                    for ($item = 0; $item < count($pecahKode10); $item++) {
                        array_push($ICD10T, $pecahKode10[$item] . " - " . $pecahNama10[$item]);
                        array_push($ICD10V, $pecahKode10[$item] . ":" . $pecahNama10[$item]);
                    }
                }

                if (array_key_exists('KodeICD9', $dataMasukPoli['DataPengkajian']['PengkajianMedis'])) {

                    $diagnosaT      = $dataMasukPoli['DataPengkajian']['PengkajianMedis']['KodeICD9'];
                    $pecahKode09    = explode(";", $diagnosaT['KodeDiagnosaT']);
                    $pecahNama09    = explode(";", $diagnosaT['DiagnosaTindakan']);

                    for ($item = 0; $item < count($pecahKode09); $item++) {
                        array_push($ICD09T, $pecahKode09[$item] . " - " . $pecahNama09[$item]);
                        array_push($ICD09V, $pecahKode09[$item] . ":" . $pecahNama09[$item]);
                    }
                }
            }
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
            return view($dataForm[0]['namaFile'] . 'Lihat', $data);
            //endIF

        } else {

            return 'Halaman yang anda tuju tidak ada';
        }
        // return view('pages.formPengkajian.pengkajianAwalPasien', $no_cm);
    }
}
