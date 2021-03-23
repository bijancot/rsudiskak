<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\ManajemenForm;
use PDF;
use File;
use App\ICD10;
use App\ICD09;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

use function GuzzleHttp\json_decode;

class RencanaTerapiController extends Controller
{
    public function rencanaTerapi(Request $request, $idForm, $NoCM, $noPendaftaran, $tglMasukPoli)
    {

        $client = new Client();
        for ($i = 1; $i <= 2; $i++) {
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ?page=' . $i);
            $statCode = $res->getStatusCode();
            $kdRuangan = $res->getBody()->getContents();
            $kdRuangan = json_decode($kdRuangan, true);

            $resKdRuangan[$i - 1] = $kdRuangan['data'];
        }

        $getKdRuangan   = Auth::user()->KodeRuangan; // not used 
        $dataDokumen    = DB::collection('dokumen_' . $NoCM)->whereNotNull('Status')->get();

        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $noPendaftaran)
            ->where('TglMasukPoli', $tglMasukPoli)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc');
        $dataMasukPoli->first();
        $kdRuangan = $dataMasukPoli->first()['KdRuangan'];

        $getDataPasien = DB::collection('pasien_' . $NoCM)
            ->where('KdRuangan', $kdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc');
        $getDataPasien->get();

        // cek LastKunjungan Pasien
        $lastKunjunganDataPasien    = ($getDataPasien->count() > 1) ? $getDataPasien->get()[1] : [];
        // create Rencana Terapi
        $lastRencanaTerapi = [
            'ObatNonRacikan' => [],
            'ObatRacikan' => [],
            'StatusTerapi' => [
                'ObatNonRacikan' => "0",
                'ObatRacikan' => "0",
            ],
        ];

        if (array_key_exists('RencanaTerapi', $lastKunjunganDataPasien)) {
            $lastRencanaTerapi = $lastKunjunganDataPasien['RencanaTerapi'];
            if (empty($lastRencanaTerapi)) {
                $lastRencanaTerapi = [
                    'ObatNonRacikan' => [],
                    'ObatRacikan' => [],
                    'StatusTerapi' => [
                        'ObatNonRacikan' => "0",
                        'ObatRacikan' => "0",
                    ],
                ];
            }
        }


        $pasienMasukPoli = $dataMasukPoli->first();

        if (empty($pasienMasukPoli['RencanaTerapi'])) {
            // jika tidak ada RencanaTerapi di DataMasuk Poli (Data masih Baru)

            // Update RencanaTerapi & StatusTerapi berdasarkan NoCM
            $queryNoCM =  DB::collection('pasien_' . $NoCM)
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('TglMasukPoli', $tglMasukPoli)
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->orderBy('created_at', 'desc');
            $queryNoCM->update(['RencanaTerapi' => $lastRencanaTerapi]);
            // $queryNoCM->push('RencanaTerapi', $lastRencanaTerapi);

            // Update RencanaTerapi & StatusTerapi berdasarkan tanggal
            $queryTgl = DB::collection('transaksi_' . $tglMasukPoli)
                ->where('NoPendaftaran', $noPendaftaran)
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian');
            $queryTgl->update(['RencanaTerapi' => $lastRencanaTerapi]);

            $pasienMasukPoli = $queryNoCM->first();
            //
        } else {
            // jika data RencanaTerapi sudah ada di DataMasuk Poli
            $rencanaTerapi = $pasienMasukPoli['RencanaTerapi'];

            if ($rencanaTerapi['StatusTerapi']['ObatNonRacikan'] == "0") {
                // dump('Do Nothing, StatusTerapi ObatNonRacikan = 0');
            }
            if ($rencanaTerapi['StatusTerapi']['ObatRacikan'] == "0") {
                // dump('Do Nothing, StatusTerapi ObatRacikan = 0');
            }
        }

        $data = [
            'idForm'                => $idForm,
            'NoCM'                  => $NoCM,
            'noPendaftaran'         => $noPendaftaran,
            'tglMasukPoli'          => $tglMasukPoli,
            'kdRuangan'             => $resKdRuangan,
            'dataMasukPoli'         => $pasienMasukPoli,
            'dataDokumen'           => $dataDokumen,
            'urlPengkajian'         => 'formPengkajian/' . $idForm . '/' . $NoCM . '/' . $noPendaftaran . '/' . $tglMasukPoli
        ];
        return view('pages.formPengkajian.rencanaTerapiPasien', $data);
    }

    public function obatNonRacikan(Request $request)
    {
        $dataMasukPoli = DB::collection('pasien_' . $request->get('NoCM'))
            ->where('KdRuangan', $request->get('KdRuangan'))
            ->where('TglMasukPoli', $request->get('TglMasukPoli'))
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        $output         = null;
        $rencanaTerapi  = null;

        if (array_key_exists('RencanaTerapi', $dataMasukPoli)) {
            $rencanaTerapi = $dataMasukPoli['RencanaTerapi'];
            $canEdit    = "false";
            if ($rencanaTerapi['StatusTerapi']['ObatNonRacikan'] == "0") {
                $canEdit    = "true";
            }

            $data = array();
            // $data = array(
            //     '0' => [
            //         '0' => "<td class='pr-1'><input type='text' placeholder='Captopril'></td>",
            //         '1' => "<td class='pr-1'><input type='text' placeholder='12.5 mg'></td>",
            //         '2' => "<td class='pr-1'><input type='text' placeholder='30'></td>",
            //         '3' => "<td class='pr-1'><input type='text' placeholder='1'></td>",
            //         '4' => "<td class='pr-1'><input type='text' placeholder='0'></td>",
            //         '5' => "<td class='pr-1'><input type='text' placeholder='1'></td>",
            //         '6' => "<td class='pr-1'><input type='text' placeholder='Setelah makan'></td>",
            //         '7' => '<td><a class="delete-nonRacikan" data-nocm="' . $dataMasukPoli["NoCM"] . '"data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '"><i class="fas fa-minus"></i></a></td>',
            //     ],
            // );
            foreach ($rencanaTerapi['ObatNonRacikan'] as $key => $rowObat) {
                $sub_array = array();
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-nonRacikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="NamaObat">'  . $rowObat['NamaObat'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-nonRacikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Dosis">'  . $rowObat['Dosis'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-nonRacikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Jumlah">'  . $rowObat['Jumlah'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-nonRacikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Pagi">'  . $rowObat['Signa']['Pagi'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-nonRacikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Siang">'  . $rowObat['Signa']['Siang'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-nonRacikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Malam">'  . $rowObat['Signa']['Malam'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-nonRacikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Keterangan">'  . $rowObat['Keterangan'] . '</div>';
                $sub_array[] = '<td><a class="delete-nonRacikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '"data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '"><i class="fas fa-minus"></i></a></td>';
                $data[] = $sub_array;
            }

            $output = array(
                // 'draw'              => $draw,
                // 'recordsTotal'      => $rencanaTerapi->count(),
                // 'recordsFiltered'   => $rencanaTerapi->count(),
                'data'              => $data
            );
        }

        return response()->json($output);
    }

    public function storeObatNonRacikan(Request $request)
    {
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        $NamaObat       = $request->get('NamaObat');
        $Dosis          = $request->get('Dosis');
        $Jumlah         = $request->get('Jumlah');
        $Pagi           = $request->get('Pagi');
        $Siang          = $request->get('Siang');
        $Malam          = $request->get('Malam');
        $Keterangan     = $request->get('Keterangan');

        // return response()->json([
        //     [$NoCM, $NoPendaftaran, $TglMasukPoli, $KdRuangan],
        //     [$NamaObat, $Dosis, $Jumlah, $Pagi, $Siang, $Malam, $Keterangan],
        // ]);

        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        $obatNonRacikan = $dataMasukPoli['RencanaTerapi']['ObatNonRacikan'];

        $updateObat     = [
            'NamaObat'  => $NamaObat,
            'Dosis'     => $Dosis,
            'Jumlah'    => $Jumlah,
            'Signa'     => [
                'Pagi'  => $Pagi,
                'Siang' => $Siang,
                'Malam' => $Malam,
            ],
            'Keterangan' => $Keterangan,
        ];

        array_push($obatNonRacikan, $updateObat);

        // update berdasarkan NoCM
        DB::collection('pasien_' . $dataMasukPoli['NoCM'])
            ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
            ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
            ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['RencanaTerapi.ObatNonRacikan' => $obatNonRacikan]);

        // update berdasarkan tanggal
        DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
            ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
            ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
            ->where('NoCM', $dataMasukPoli['NoCM'])
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['RencanaTerapi.ObatNonRacikan' => $obatNonRacikan]);
    }

    public function updateObatNonRacikan(Request $request)
    {
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        $dataRow        = $request->get('rows');
        $dataCol        = $request->get('column_name');
        $dataVal        = $request->get('value');
        // return response()->json([[$NoCM, $NoPendaftaran, $TglMasukPoli, $KdRuangan], [$dataRow, $dataCol, $dataVal]]);

        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();
        // return response()->json([$dataMasukPoli]);

        if (array_key_exists('RencanaTerapi', $dataMasukPoli)) {

            if ($dataCol == "Pagi" || $dataCol == "Siang" || $dataCol == "Malam") {
                // update berdasarkan NoCM
                DB::collection('pasien_' . $dataMasukPoli['NoCM'])
                    ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                    ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
                    ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                    ->where('deleted_at', null)
                    ->whereNotNull('StatusPengkajian')
                    ->update(['RencanaTerapi.ObatNonRacikan.' . $dataRow . '.Signa.' . $dataCol => $dataVal]);

                // update berdasarkan tanggal
                DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
                    ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                    ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                    ->where('NoCM', $dataMasukPoli['NoCM'])
                    ->where('deleted_at', null)
                    ->whereNotNull('StatusPengkajian')
                    ->update(['RencanaTerapi.ObatNonRacikan.' . $dataRow . '.Signa.' . $dataCol => $dataVal]);

                // end Signa
            } else {
                // update berdasarkan NoCM
                DB::collection('pasien_' . $dataMasukPoli['NoCM'])
                    ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                    ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
                    ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                    ->where('deleted_at', null)
                    ->whereNotNull('StatusPengkajian')
                    ->update(['RencanaTerapi.ObatNonRacikan.' . $dataRow . '.' . $dataCol => $dataVal]);

                // update berdasarkan tanggal
                DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
                    ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                    ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                    ->where('NoCM', $dataMasukPoli['NoCM'])
                    ->where('deleted_at', null)
                    ->whereNotNull('StatusPengkajian')
                    ->update(['RencanaTerapi.ObatNonRacikan.' . $dataRow . '.' . $dataCol => $dataVal]);
            }
        }
    }

    public function destroyObatNonRacikan(Request $request)
    {
        $dataRow        = $request->get('rows');
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        // return response()->json([
        //     $dataRow, $dataMasukPoli
        // ]);

        if (array_key_exists('RencanaTerapi', $dataMasukPoli)) {

            $obatNonRacikan = $dataMasukPoli['RencanaTerapi']['ObatNonRacikan'];
            array_splice($obatNonRacikan, $dataRow, 1);

            // update berdasarkan NoCM
            DB::collection('pasien_' . $dataMasukPoli['NoCM'])
                ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
                ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['RencanaTerapi.ObatNonRacikan' => $obatNonRacikan]);

            // update berdasarkan tanggal
            DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
                ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                ->where('NoCM', $dataMasukPoli['NoCM'])
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['RencanaTerapi.ObatNonRacikan' => $obatNonRacikan]);
        }
    }

    public function lockObatNonRacikan(Request $request)
    {
        $status         = $request->get('status');
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        // get berdasarkan Pasien NoCM
        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc');
        $dataMasukPoli->first();

        $pasienMasukPoli = $dataMasukPoli->first();
        // dd([$status, $pasienMasukPoli]);

        if (array_key_exists('RencanaTerapi', $pasienMasukPoli)) {

            $dataMasukPoli->update(['RencanaTerapi.StatusTerapi.ObatNonRacikan' => "1"]);

            // update berdasarkan tanggal
            DB::collection('transaksi_' . $pasienMasukPoli['TglMasukPoli'])
                ->where('NoPendaftaran', $pasienMasukPoli['NoPendaftaran'])
                ->where('KdRuangan', $pasienMasukPoli['KdRuangan'])
                ->where('NoCM', $pasienMasukPoli['NoCM'])
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['RencanaTerapi.StatusTerapi.ObatNonRacikan' => "1"]);
        }

        return redirect()->back()->with('statusNotif', 'success')->with('lock', 'nonRacik');
    }

    public function unlockObatNonRacikan(Request $request)
    {
        $status         = $request->get('status');
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        // get berdasarkan Pasien NoCM
        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc');
        $dataMasukPoli->first();

        $pasienMasukPoli = $dataMasukPoli->first();
        // dd([$status, $pasienMasukPoli]);

        if (array_key_exists('RencanaTerapi', $pasienMasukPoli)) {

            $dataMasukPoli->update(['RencanaTerapi.StatusTerapi.ObatNonRacikan' => "0"]);

            // update berdasarkan tanggal
            DB::collection('transaksi_' . $pasienMasukPoli['TglMasukPoli'])
                ->where('NoPendaftaran', $pasienMasukPoli['NoPendaftaran'])
                ->where('KdRuangan', $pasienMasukPoli['KdRuangan'])
                ->where('NoCM', $pasienMasukPoli['NoCM'])
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['RencanaTerapi.StatusTerapi.ObatNonRacikan' => "0"]);
        }

        return redirect()->back()->with('statusNotif', 'success')->with('unlock', 'nonRacik');
    }


    public function obatRacikan(Request $request)
    {
        $dataMasukPoli = DB::collection('pasien_' . $request->get('NoCM'))
            ->where('KdRuangan', $request->get('KdRuangan'))
            ->where('TglMasukPoli', $request->get('TglMasukPoli'))
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        $output         = null;
        $rencanaTerapi  = null;

        if (array_key_exists('RencanaTerapi', $dataMasukPoli)) {
            $rencanaTerapi = $dataMasukPoli['RencanaTerapi'];

            $canEdit    = "false";
            if ($rencanaTerapi['StatusTerapi']['ObatRacikan'] == "0") {
                $canEdit    = "true";
            }

            $data = array();
            foreach ($rencanaTerapi['ObatRacikan'] as $key => $rowObat) {
                $sub_array = array();
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="NamaObat">'  . $rowObat['NamaObat'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Dosis">'  . $rowObat['Dosis'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="RacikanDalam">'  . $rowObat['RacikanDalam'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Jumlah">'  . $rowObat['Jumlah'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Pagi">'  . $rowObat['Signa']['Pagi'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Siang">'  . $rowObat['Signa']['Siang'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Malam">'  . $rowObat['Signa']['Malam'] . '</div>';
                $sub_array[] = '<div contenteditable="' . $canEdit . '" class="update-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '" data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '" data-column="Keterangan">'  . $rowObat['Keterangan'] . '</div>';
                $sub_array[] = '<td><a class="delete-Racikan" data-rows="' . $key . '" data-nocm="' . $dataMasukPoli["NoCM"] . '"data-kdruangan="' . $dataMasukPoli["KdRuangan"] . '"><i class="fas fa-minus"></i></a></td>';
                $data[] = $sub_array;
            }

            $output = array(
                // 'draw'              => $draw,
                // 'recordsTotal'      => $rencanaTerapi->count(),
                // 'recordsFiltered'   => $rencanaTerapi->count(),
                'data'              => $data
            );
        }

        return response()->json($output);
    }

    public function storeObatRacikan(Request $request)
    {
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        $NamaObat       = $request->get('NamaObat');
        $Dosis          = $request->get('Dosis');
        $RacikanDalam   = $request->get('RacikanDalam');
        $Jumlah         = $request->get('Jumlah');
        $Pagi           = $request->get('Pagi');
        $Siang          = $request->get('Siang');
        $Malam          = $request->get('Malam');
        $Keterangan     = $request->get('Keterangan');

        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        $obatRacikan = $dataMasukPoli['RencanaTerapi']['ObatRacikan'];

        $updateObat         = [
            'NamaObat'      => $NamaObat,
            'Dosis'         => $Dosis,
            'RacikanDalam'  => $RacikanDalam,
            'Jumlah'        => $Jumlah,
            'Signa'         => [
                'Pagi'      => $Pagi,
                'Siang'     => $Siang,
                'Malam'     => $Malam,
            ],
            'Keterangan'    => $Keterangan,
        ];

        array_push($obatRacikan, $updateObat);

        // update berdasarkan NoCM
        DB::collection('pasien_' . $dataMasukPoli['NoCM'])
            ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
            ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
            ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['RencanaTerapi.ObatRacikan' => $obatRacikan]);

        // update berdasarkan tanggal
        DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
            ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
            ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
            ->where('NoCM', $dataMasukPoli['NoCM'])
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->update(['RencanaTerapi.ObatRacikan' => $obatRacikan]);
    }

    public function updateObatRacikan(Request $request)
    {
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        $dataRow        = $request->get('rows');
        $dataCol        = $request->get('column_name');
        $dataVal        = $request->get('value');

        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        if (array_key_exists('RencanaTerapi', $dataMasukPoli)) {

            if ($dataCol == "Pagi" || $dataCol == "Siang" || $dataCol == "Malam") {
                // update berdasarkan NoCM
                DB::collection('pasien_' . $dataMasukPoli['NoCM'])
                    ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                    ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
                    ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                    ->where('deleted_at', null)
                    ->whereNotNull('StatusPengkajian')
                    ->update(['RencanaTerapi.ObatRacikan.' . $dataRow . '.Signa.' . $dataCol => $dataVal]);

                // update berdasarkan tanggal
                DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
                    ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                    ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                    ->where('NoCM', $dataMasukPoli['NoCM'])
                    ->where('deleted_at', null)
                    ->whereNotNull('StatusPengkajian')
                    ->update(['RencanaTerapi.ObatRacikan.' . $dataRow . '.Signa.' . $dataCol => $dataVal]);

                // end Signa
            } else {
                // update berdasarkan NoCM
                DB::collection('pasien_' . $dataMasukPoli['NoCM'])
                    ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                    ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
                    ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                    ->where('deleted_at', null)
                    ->whereNotNull('StatusPengkajian')
                    ->update(['RencanaTerapi.ObatRacikan.' . $dataRow . '.' . $dataCol => $dataVal]);

                // update berdasarkan tanggal
                DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
                    ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                    ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                    ->where('NoCM', $dataMasukPoli['NoCM'])
                    ->where('deleted_at', null)
                    ->whereNotNull('StatusPengkajian')
                    ->update(['RencanaTerapi.ObatRacikan.' . $dataRow . '.' . $dataCol => $dataVal]);
            }
        }
    }

    public function destroyObatRacikan(Request $request)
    {
        $dataRow        = $request->get('rows');
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc')
            ->first();

        if (array_key_exists('RencanaTerapi', $dataMasukPoli)) {

            $obatRacikan = $dataMasukPoli['RencanaTerapi']['ObatRacikan'];
            array_splice($obatRacikan, $dataRow, 1);

            // update berdasarkan NoCM
            DB::collection('pasien_' . $dataMasukPoli['NoCM'])
                ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                ->where('TglMasukPoli', $dataMasukPoli['TglMasukPoli'])
                ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['RencanaTerapi.ObatRacikan' => $obatRacikan]);

            // update berdasarkan tanggal
            DB::collection('transaksi_' . $dataMasukPoli['TglMasukPoli'])
                ->where('NoPendaftaran', $dataMasukPoli['NoPendaftaran'])
                ->where('KdRuangan', $dataMasukPoli['KdRuangan'])
                ->where('NoCM', $dataMasukPoli['NoCM'])
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['RencanaTerapi.ObatRacikan' => $obatRacikan]);
        }
    }

    public function lockObatRacikan(Request $request)
    {
        $status         = $request->get('status');
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        // get berdasarkan Pasien NoCM
        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc');
        $dataMasukPoli->first();

        $pasienMasukPoli = $dataMasukPoli->first();
        // dd([$status, $pasienMasukPoli]);

        if (array_key_exists('RencanaTerapi', $pasienMasukPoli)) {

            $dataMasukPoli->update(['RencanaTerapi.StatusTerapi.ObatRacikan' => "1"]);

            // update berdasarkan tanggal
            DB::collection('transaksi_' . $pasienMasukPoli['TglMasukPoli'])
                ->where('NoPendaftaran', $pasienMasukPoli['NoPendaftaran'])
                ->where('KdRuangan', $pasienMasukPoli['KdRuangan'])
                ->where('NoCM', $pasienMasukPoli['NoCM'])
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['RencanaTerapi.StatusTerapi.ObatRacikan' => "1"]);
        }

        return redirect()->back()->with('statusNotif', 'success')->with('lock', 'Racik');
    }

    public function unlockObatRacikan(Request $request)
    {
        $status         = $request->get('status');
        $NoCM           = $request->get('NoCM');
        $NoPendaftaran  = $request->get('NoPendaftaran');
        $TglMasukPoli   = $request->get('TglMasukPoli');
        $KdRuangan      = $request->get('KdRuangan');

        // get berdasarkan Pasien NoCM
        $dataMasukPoli = DB::collection('pasien_' . $NoCM)
            ->where('NoPendaftaran', $NoPendaftaran)
            ->where('TglMasukPoli', $TglMasukPoli)
            ->where('KdRuangan', $KdRuangan)
            ->where('deleted_at', null)
            ->whereNotNull('StatusPengkajian')
            ->orderBy('created_at', 'desc');
        $dataMasukPoli->first();

        $pasienMasukPoli = $dataMasukPoli->first();
        // dd([$status, $pasienMasukPoli]);

        if (array_key_exists('RencanaTerapi', $pasienMasukPoli)) {

            $dataMasukPoli->update(['RencanaTerapi.StatusTerapi.ObatRacikan' => "0"]);

            // update berdasarkan tanggal
            DB::collection('transaksi_' . $pasienMasukPoli['TglMasukPoli'])
                ->where('NoPendaftaran', $pasienMasukPoli['NoPendaftaran'])
                ->where('KdRuangan', $pasienMasukPoli['KdRuangan'])
                ->where('NoCM', $pasienMasukPoli['NoCM'])
                ->where('deleted_at', null)
                ->whereNotNull('StatusPengkajian')
                ->update(['RencanaTerapi.StatusTerapi.ObatRacikan' => "0"]);
        }

        return redirect()->back()->with('statusNotif', 'success')->with('unlock', 'Racik');
    }
}
