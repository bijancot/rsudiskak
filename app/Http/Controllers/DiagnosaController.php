<?php

namespace App\Http\Controllers;

use App\AntrianPasien;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Auth;

class DiagnosaController extends Controller
{
    public function diagnosaAwal($no_cm = null)
    {
        if ($no_cm != null) {

            //get data
            $client = new Client();
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/' . $no_cm);
            $statCode = $res->getStatusCode();
            $showPasien = $res->getBody()->getContents();
            $showPasien = json_decode($showPasien, true);
            $showPasien = $showPasien['response'];

            $data = [
                'no_cm'     => $no_cm,
                'data'      => $showPasien,
            ];
            return view('pages.diagnosa', $data);
            // return redirect('pages.diagnosa', $data);
            // endif

        } else {
            "No_CM tidak ada";
        }
    }

    public function storeDiagnosaAwal($no_cm)
    {
        // Check isNext Diagnosa Akhir
        if(Auth::user()->KdJabatan == "1"){
            return redirect('diagnosaAkhir/'.$no_cm);
        }else if(Auth::user()->KdJabatan == "2"){
            $view = new PasienController();
            return $view->listPasien();
        }
    }

    public function diagnosaAkhir($no_cm = null)
    {
        if ($no_cm != null) {
            //get data
            $client = new Client();
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/' . $no_cm);
            $statCode = $res->getStatusCode();
            $showPasien = $res->getBody()->getContents();
            $showPasien = json_decode($showPasien, true);
            $showPasien = $showPasien['response'];

            // Check Klasifikasi Diagnosa
            if(Auth::user()->KdJabatan == "1"){
                $isDisabled = "";
            }else if(Auth::user()->KdJabatan == "2"){
                $isDisabled = "disabled";
            }

            $data = [
                'isDisabled' => $isDisabled,
                'data'      => $showPasien
            ];

            return view('pages.diagnosaAkhir', $data);
        } else {
            "No_CM tidak ada";
        }
    }
    public function storeDiagnosaAkhir($no_cm = null)
    {
        $view = new PasienController();
        return $view->listPasien();
    }

    public function dataResep()
    {
        return view('pages.dataResep');
    }

    public function pilihDokter($no_cm = null)
    {

        if ($no_cm != null) {


            $getDokter = $this->listDokter();
            $data = [
                'listDokter'        => $getDokter,
                'no_cm'             => $no_cm,
            ];
            return view('pages.pilihDokter', $data);
            //endif

        } else {
            "No_CM tidak ada";
        }
    }

    public function storePilihDokter(Request $request, $no_cm)
    {

        if ($no_cm) {

            $getAntrian = $this->antrianDataPasien();
            $jmlAntrian = collect($getAntrian['data'])->count();
            for ($x = 0; $x < $jmlAntrian; $x++) {

                if ($getAntrian['data'][$x]['NoCM'] == $no_cm) {
                    break;
                }
            }
            $a = $getAntrian['data'][$x];

            $getDataPasien = $this->dataPasien($no_cm);

            $getDokter = $this->listDokter();
            $jmlDokter = collect($getDokter['data'])->count();
            for ($d = 0; $d < $jmlDokter; $d++) {
                if ($getDokter['data'][$d]['IdDokter'] == $request->get('dokter')) {

                    break;
                }
            }
            $NamaDokter = $getDokter['data'][$d]['NamaLengkap'];

            /**
             * Simpan data Pasien berdasarkan NoCM
             */
            $antrianPasien_noCM = new AntrianPasien();
            $antrianPasien_noCM->collection             = "pasien_" . $request->get('no_cm');
            $antrianPasien_noCM->NoCM                   = $request->get('no_cm');
            $antrianPasien_noCM->NoUrut                 = $a['No. Urut'];
            $antrianPasien_noCM->NoPendaftaran          = $a['NoPendaftaran'];
            $antrianPasien_noCM->TglMasuk               = date("Y-m-d H:i:s", strtotime($a['TglMasuk']));
            $antrianPasien_noCM->jenisPasien            = $a['Jenis Pasien'];
            $antrianPasien_noCM->Ruangan                = $a['Ruangan'];
            $antrianPasien_noCM->KdRuangan              = $a['KdRuangan'];
            $antrianPasien_noCM->KdSubInstalasi         = $a['KdSubInstalasi'];
            $antrianPasien_noCM->StatusPasien           = $a['StatusPasien'];
            $antrianPasien_noCM->KdKelas                = $a['KdKelas'];
            $antrianPasien_noCM->StatusPeriksa          = $a['Status Periksa'];
            $antrianPasien_noCM->IdPenjamin             = $a['IdPenjamin'];
            $antrianPasien_noCM->IdDokter               = $request->get('dokter');
            $antrianPasien_noCM->NamaDokter             = $NamaDokter;
            $antrianPasien_noCM->KdInstalasi            = $a['KdInstalasi'];
            $antrianPasien_noCM->KodeReservasi          = $a['KodeReservasi'];
            $antrianPasien_noCM->Status                 = $a['Status'];
            $antrianPasien_noCM->NoIdentitas            = $getDataPasien['NoIdentitas'];
            $antrianPasien_noCM->TglDaftarMembership    = $getDataPasien['TglDaftarMembership'];
            $antrianPasien_noCM->Title                  = $getDataPasien['Title'];
            $antrianPasien_noCM->NamaLengkap            = $getDataPasien['NamaLengkap'];
            $antrianPasien_noCM->TempatLahir            = $getDataPasien['TempatLahir'];
            $antrianPasien_noCM->TglLahir               = $getDataPasien['TglLahir'];
            $antrianPasien_noCM->JenisKelamin           = $getDataPasien['JenisKelamin'];
            $antrianPasien_noCM->Alamat                 = $getDataPasien['Alamat'];
            $antrianPasien_noCM->Telepon                = $getDataPasien['Telepon'];
            $antrianPasien_noCM->NamaIbu                = $getDataPasien['NamaIbu'];
            $antrianPasien_noCM->Umur                   = $getDataPasien['Umur'];
            $antrianPasien_noCM->UmurTahun              = $getDataPasien['UmurTahun'];
            $antrianPasien_noCM->UmurBulan              = $getDataPasien['UmurBulan'];
            $antrianPasien_noCM->UmurHari               = $getDataPasien['UmurHari'];
            $antrianPasien_noCM->Kelurahan              = $getDataPasien['Kelurahan'];
            $antrianPasien_noCM->Kecamatan              = $getDataPasien['Kecamatan'];
            $antrianPasien_noCM->Kota                   = $getDataPasien['Kota'];
            $antrianPasien_noCM->NoCmTemp               = $getDataPasien['NoCmTemp'];
            $antrianPasien_noCM->NoCmOld                = $getDataPasien['NoCmOld'];
            $antrianPasien_noCM->NamaAyah               = $getDataPasien['NamaAyah'];
            $antrianPasien_noCM->NoKK                   = $getDataPasien['NoKK'];
            $antrianPasien_noCM->NamaSuamiIstri         = $getDataPasien['NamaSuamiIstri'];
            $antrianPasien_noCM->Propinsi               = $getDataPasien['Propinsi'];
            $antrianPasien_noCM->RTRW                   = $getDataPasien['RTRW'];
            $antrianPasien_noCM->updated_at             = null;
            $antrianPasien_noCM->deleted_at             = null;
            $antrianPasien_noCM->save();

            /**
             * Simpan Transaksi berdasarkan tanggal
             */
            $antrianPasien_tgl = new AntrianPasien();
            $antrianPasien_tgl->collection              = "transaksi_" . date("Y-m-d");
            $antrianPasien_tgl->NoCM                    = $request->get('no_cm');
            $antrianPasien_tgl->NoUrut                  = $a['No. Urut'];
            $antrianPasien_tgl->NoPendaftaran           = $a['NoPendaftaran'];
            $antrianPasien_tgl->TglMasuk                = date("Y-m-d H:i:s", strtotime($a['TglMasuk']));
            $antrianPasien_tgl->jenisPasien             = $a['Jenis Pasien'];
            $antrianPasien_tgl->Ruangan                 = $a['Ruangan'];
            $antrianPasien_tgl->KdRuangan               = $a['KdRuangan'];
            $antrianPasien_tgl->KdSubInstalasi          = $a['KdSubInstalasi'];;
            $antrianPasien_tgl->StatusPasien            = $a['StatusPasien'];
            $antrianPasien_tgl->KdKelas                 = $a['KdKelas'];
            $antrianPasien_tgl->StatusPeriksa           = $a['Status Periksa'];
            $antrianPasien_tgl->IdPenjamin              = $a['IdPenjamin'];
            $antrianPasien_tgl->IdDokter                = $request->get('dokter');
            $antrianPasien_tgl->NamaDokter              = $NamaDokter;
            $antrianPasien_tgl->KdInstalasi             = $a['KdInstalasi'];
            $antrianPasien_tgl->KodeReservasi           = $a['KodeReservasi'];
            $antrianPasien_tgl->Status                  = $a['Status'];
            $antrianPasien_tgl->NoIdentitas             = $getDataPasien['NoIdentitas'];
            $antrianPasien_tgl->TglDaftarMembership     = $getDataPasien['TglDaftarMembership'];
            $antrianPasien_tgl->Title                   = $getDataPasien['Title'];
            $antrianPasien_tgl->NamaLengkap             = $getDataPasien['NamaLengkap'];
            $antrianPasien_tgl->TempatLahir             = $getDataPasien['TempatLahir'];
            $antrianPasien_tgl->TglLahir                = $getDataPasien['TglLahir'];
            $antrianPasien_tgl->JenisKelamin            = $getDataPasien['JenisKelamin'];
            $antrianPasien_tgl->Alamat                  = $getDataPasien['Alamat'];
            $antrianPasien_tgl->Telepon                 = $getDataPasien['Telepon'];
            $antrianPasien_tgl->NamaIbu                 = $getDataPasien['NamaIbu'];
            $antrianPasien_tgl->Umur                    = $getDataPasien['Umur'];
            $antrianPasien_tgl->UmurTahun               = $getDataPasien['UmurTahun'];
            $antrianPasien_tgl->UmurBulan               = $getDataPasien['UmurBulan'];
            $antrianPasien_tgl->UmurHari                = $getDataPasien['UmurHari'];
            $antrianPasien_tgl->Kelurahan               = $getDataPasien['Kelurahan'];
            $antrianPasien_tgl->Kecamatan               = $getDataPasien['Kecamatan'];
            $antrianPasien_tgl->Kota                    = $getDataPasien['Kota'];
            $antrianPasien_tgl->NoCmTemp                = $getDataPasien['NoCmTemp'];
            $antrianPasien_tgl->NoCmOld                 = $getDataPasien['NoCmOld'];
            $antrianPasien_tgl->NamaAyah                = $getDataPasien['NamaAyah'];
            $antrianPasien_tgl->NoKK                    = $getDataPasien['NoKK'];
            $antrianPasien_tgl->NamaSuamiIstri          = $getDataPasien['NamaSuamiIstri'];
            $antrianPasien_tgl->Propinsi                = $getDataPasien['Propinsi'];
            $antrianPasien_tgl->RTRW                    = $getDataPasien['RTRW'];
            $antrianPasien_tgl->updated_at              = null;
            $antrianPasien_tgl->deleted_at              = null;
            $antrianPasien_tgl->save();

            /**
             * Post API Masuk Poliklinik
             */
            $client = new Client();
            $res = $client->request('POST', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/masukpoli', [
                "nopendaftaran" => $a['NoPendaftaran'],
                "iddokter"      => $request->get('dokter'),
                "tglmasuk"      => date("Y-m-d H:i:s", strtotime($a['TglMasuk']))
            ]);
            $statCode = $res->getStatusCode();
            // echo $statCode;

            return redirect('/listPasien');
            //endIf

        } else {
            "Data gagal disimpan";
        }
    }

    public function listDokter()
    {
        //get data
        $client = new Client();
        $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/listdokter/kdruangan/215');
        $statCode = $res->getStatusCode();
        $datas = $res->getBody()->getContents();
        $datas = json_decode($datas, true);
        $datas = $datas['response'];

        return $datas;
    }

    public function dataPasien($no_cm = null)
    {
        //get data
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/caridatapasien/' . $no_cm);
        $statCode = $res->getStatusCode();
        $data = $res->getBody()->getContents();
        $data = json_decode($data, true);
        $data = $data['response'];

        return $data;
    }

    public function antrianDataPasien()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/antrianpoli/215?tglawal=2020-09-21&tglakhir=' . date("Y-m-d"));
        $statCode = $res->getStatusCode();
        $datas = $res->getBody()->getContents();
        $datas = json_decode($datas, true);
        $datas = $datas['response'];

        return $datas;
    }
}
