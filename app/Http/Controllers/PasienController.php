<?php

namespace App\Http\Controllers;

use App\AntrianPasien;
use App\ManajemenForm;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listPasien()
    {
        // get data
        $getKdRuangan   = Auth::user()->KodeRuangan;

        date_default_timezone_set('Asia/Jakarta');

        $client = new Client();
        $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/' . $getKdRuangan . '?tglawal=2020-09-21andtglakhir=' . date("Y-m-d"));
        // $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/215?tglawal=2020-09-21&tglakhir=' . date("Y-m-d"));
        // $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/215');
        // $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/' . $getKdRuangan);
        $statCode = $res->getStatusCode();
        $antriPoli = $res->getBody()->getContents();
        $antriPoli = json_decode($antriPoli, true);
        $antriPoli = $antriPoli['response'];

        $masukPoli = new AntrianPasien();
        $masukPoli->collection  = "transaksi_" . date("Y-m-d");
        // $masukPoli->get();
        $getPasienMasukPoli     = $masukPoli->where('deleted_at', null)->where('KdRuangan', $getKdRuangan)->orderBy('WaktuMasukPoli', 'ASC')->get();


        if (Auth::user()->Role == "1") {

            $role             = "1";
            $ID               = Auth::user()->ID;
            $getKdRuangan     = Auth::user()->KodeRuangan;
            $getPasienMasukPoli     = $masukPoli->where('deleted_at', null)->where('IdDokter', $ID)->where('KdRuangan', $getKdRuangan)->orderBy('WaktuMasukPoli', 'ASC')->get();
            // endIf

        } else if (Auth::user()->Role == "2") {

            $ID = Auth::user()->ID;
            $role = "2";
            // endElseIf
        }

        // $diagnosa  = new DiagnosaController();
        // $getlistDokter = $diagnosa->listDokter();

        $getlistDokter = User::where([
            ['Role', '=', '1'],
            ['KodeRuangan', '=', $getKdRuangan],
        ])->orderBy('Nama', 'asc')->get();

        $getForm = ManajemenForm::all();

        $datax = [
            'ID'                => $ID,
            'role'              => $role,
            'datas'             => $antriPoli,
            'masukPoli'         => $getPasienMasukPoli,
            'listDokter'        => $getlistDokter,
            'listForm'          => $getForm,
        ];

        return view('pages.listPasien', $datax);
    }

    public function getDataByDate(Request $request)
    {
        $getKdRuangan   = Auth::user()->KodeRuangan;
        date_default_timezone_set('Asia/Jakarta');

        $date = date("Y-m-d", strtotime($request->get('date')));

        $masukPoli = new AntrianPasien();
        $masukPoli->collection  = "transaksi_" . $date;
        $getPasienMasukPoli     = $masukPoli->where('deleted_at', null)->where('KdRuangan', $getKdRuangan)->orderBy('WaktuMasukPoli', 'ASC')->get();

        if (Auth::user()->Role == "1") {

            $role             = "1";
            $ID               = Auth::user()->ID;
            $getKdRuangan     = Auth::user()->KodeRuangan;
            $getPasienMasukPoli     = $masukPoli->where('deleted_at', null)->where('IdDokter', $ID)->where('KdRuangan', $getKdRuangan)->orderBy('WaktuMasukPoli', 'ASC')->get();
            // endIf

        } else if (Auth::user()->Role == "2") {

            $ID = Auth::user()->ID;
            $role = "2";
            // endElseIf
        }

        $html       = "";
        $pilihForm  = "";
        $isiForm    = "";
        $batalForm  = "";

        foreach ($getPasienMasukPoli as $poli) {
            $StatusPengkajian = "";
            // set style status periksa
            if ($poli['StatusPengkajian'] == "0") {
                $StatusPengkajian = "Belum";
                $status = "orange";
            } else if ($poli['StatusPengkajian'] == "1") {
                $StatusPengkajian = "Periksa";
                $status = "yellow";
            } else if ($poli['StatusPengkajian'] == "2") {
                $StatusPengkajian = "Selesai";
                $status = "blue";
            }
            // set detail JK
            $jenkel = ($poli['JenisKelamin'] == "L" ? "Laki - Laki" : "Perempuan");
            // check if disabled button
            $isDisabled = ($poli['StatusPengkajian'] == '2' ? 'disabled' : '');

            if ($poli['StatusPengkajian'] == 0) {
                $pilihForm   = "<a data-toggle='modal' data-target='#modal_pilih_form-" . $poli['NoCM'] . "-" . $poli['NoPendaftaran'] . "' class='btn diagnosa " . $isDisabled . "'>Pilih Form Pengkajian</a>";
                $isiForm     = "";
                $batalForm   = "";
            } else {
                $pilihForm   = "";
                $isiForm     = "<a href='" . url('formPengkajian/' . $poli['IdFormPengkajian'] . '/' . $poli['NoCM'] . '/' . $poli['NoPendaftaran'] . '/' . $poli['TglMasukPoli']) . "' class='btn diagnosa " . $isDisabled . "'>Isi Form</a>";
                $batalForm   = "<a href='" . url('pilihForm/' . $poli['NoCM']) . "' data-toggle='modal' data-pendaftaran='" . $poli['NoPendaftaran'] . "' data-nocm='" . $poli['NoCM'] . "' data-target='#modal_batal_form' class='btn batal batalForm " . $isDisabled . "'>Batal Form</a>";
            }

            if ($role == "1" && $poli['StatusPengkajian'] != "") {
                $html .= " 
                    <tr>
                        <td data-label='No Pendaftaran'>" . $poli['NoPendaftaran'] . "</td>
                        <td data-label='No Rekam Medis'>" . $poli['NoCM'] . "</td>
                        <td data-label='Dok. Pemeriksa'>" . $poli['NamaDokter'] . "</td>
                        <td data-label='Nama Pasien'>" . $poli['NamaLengkap'] . "</td>
                        <td data-label='Umur'>" . $poli['UmurTahun'] . " Th</td>
                        <td data-label='Jenis Kelamin'>" . $jenkel . "</td>
                        <td data-label='Tanggal Masuk'>" . date("d/m/Y", strtotime($poli['TglMasuk'])) . "</td>
                        <td data-label='Keterangan'>
                            <span class='ml-auto label-keterangan " . $status . "'>" . $StatusPengkajian . "</span>
                        </td>
                        <td data-label='Action' class='d-flex flex-row p-lg-1'> 
                            " . $pilihForm . "" . $isiForm . "" . $batalForm . " 
                            <a data-toggle='modal' data-target='#modal_batal_masukPoli-" . $poli['NoCM'] . "-" . $poli['NoPendaftaran'] . "' class='btn btn-secondary " . $isDisabled . "'>Batal Masuk Poli</a>
                        </td>
                    </tr> ";
            } elseif ($role == "2" && $poli['StatusPengkajian'] != "") {
                $html .= " 
                    <tr>
                        <td data-label='No Pendaftaran'>" . $poli['NoPendaftaran'] . "</td>
                        <td data-label='No Rekam Medis'>" . $poli['NoCM'] . "</td>
                        <td data-label='Dok. Pemeriksa'>" . $poli['NamaDokter'] . "</td>
                        <td data-label='Nama Pasien'>" . $poli['NamaLengkap'] . "</td>
                        <td data-label='Umur'>" . $poli['UmurTahun'] . " Th</td>
                        <td data-label='Jenis Kelamin'>" . $jenkel . "</td>
                        <td data-label='Tanggal Masuk'>" . date("d/m/Y", strtotime($poli['TglMasuk'])) . "</td>
                        <td data-label='Keterangan'>
                            <span class='ml-auto label-keterangan " . $status . "'>" . $StatusPengkajian . "</span>
                        </td>
                        <td data-label='Action' class='d-flex flex-row p-lg-1'> 
                            " . $pilihForm . "" . $isiForm . "" . $batalForm . " 
                            <a data-toggle='modal' data-target='#modal_batal_masukPoli-" . $poli['NoCM'] . "-" . $poli['NoPendaftaran'] . "' class='btn btn-secondary " . $isDisabled . "'>Batal Masuk Poli</a>
                        </td>
                    </tr>";
            }
        }

        $data = [
            'html' => $html
        ];

        return response()->json($data);
    }

    public function dataPasien($no_cm)
    {
        //get data
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/' . $no_cm);
        $statCode = $res->getStatusCode();
        $data = $res->getBody()->getContents();
        $data = json_decode($data, true);
        $data = $data['response'];

        return view('pages.dataPasien', compact('data'));
    }

    public function storeBatalPeriksa(Request $request, $no_cm = null, $no_pendaftaran = null)
    {

        $getKdRuangan   = Auth::user()->KodeRuangan;

        $logging        = new LoggingController;

        if ($no_pendaftaran) {
            /**
             * Post API Batal Periksa Poliklinik
             */
            $client = new Client();
            $res = $client->request('POST', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/batal', [
                "nopendaftaran"  => $no_pendaftaran,
                "kdruangan"      => $getKdRuangan,
                "keterangan"     => $request->get('keterangan')
            ]);
            $statCode = $res->getStatusCode();
            // dump($statCode);

            $batal_periksa = [
                'no_pendaftaran' => $no_pendaftaran,
                'keterangan'     => $request->get('keterangan'),
            ];

            $logging->toLogging('batal', 'BatalPeriksa', $batal_periksa, $no_cm);

            return redirect('/listPasien');
            //endIf

        } else {
            "Gagal Melakukan aksi";
        }
    }

    public function ListPasienKirimPoli()
    {
        return view('pages.listPasienKirimPoli');
    }

    public function ListPasienHasilLab()
    {
        return view('pages.listPasienHasilLab');
    }

    public function Riwayat($no_cm)
    {
        if ($no_cm != null) {
            //get data
            $client = new Client();
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/' . $no_cm);
            $statCode = $res->getStatusCode();
            $showPasien = $res->getBody()->getContents();
            $showPasien = json_decode($showPasien, true);
            $showPasien = $showPasien['response'];

            $data = ['data' => $showPasien];
            return view('pages.riwayat', $data);
        } else {
            "No_CM tidak ada";
        }
    }
}
