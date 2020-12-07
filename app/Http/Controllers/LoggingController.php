<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logging;
use Illuminate\Support\Facades\Auth;

class LoggingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $logging = new Logging();
        $logging->collection    = "loggings_" . date("Y-m-d");
        $listLog                = $logging->orderBy('_id', 'desc')->get();
        $data = [
            'listLog' => $listLog
        ];

        return view('pages.admin.logActivities', $data);
    }



    // public function getDataByDate(Request $req)
    // {
    //     date_default_timezone_set('Asia/Jakarta');
    //     $masukPoli = new AntrianPasien();
    //     $masukPoli->collection  = "transaksi_" . $req->get('date');
    //     $listPasienMasukPoli            = $masukPoli->whereNotNull('StatusPengkajian')->where('StatusPengkajian', '2')->get();
    //     $html = "";
    //     $action = "";
    //     $ver = "";
    //     $lihatForm = "";
    //     foreach ($listPasienMasukPoli as $data) {
    //         if ($data['IdFormPengkajian'] == "1") {
    //             $lihatForm = "<a href='lihatFormPengkajian/" . $data['IdFormPengkajian'] . "/" . $data['NoCM'] . "/" . $data['NoPendaftaran'] . "/" . $data['TglMasukPoli'] . "' class='btn btn-primary'><i class='fas fa-eye'></i> Lihat Form</a>";
    //             $action = "<a href='riwayatPasienAwal/" . $data['TglMasukPoli'] . "/" . $data['NoPendaftaran'] . "' target='_blank' class='btn diagnosa'><i class='fas fa-print'></i> Print</a>";
    //             if (Auth::user()->Role == '003') {
    //                 $ver = "<a href='#' data-toggle='modal' data-target='#modal_hapus' data-nopendaftaran='" . $data['NoPendaftaran'] . "' data-nocm='" . $data['NoCM'] . "' data-tanggal='" . $data['TglMasukPoli'] . "' class='btn hapus-data batal'>Batal Verifikasi</a>";
    //             }
    //         } elseif ($data['IdFormPengkajian'] == "2") {
    //             $lihatForm = "<a href='lihatFormPengkajian/" . $data['IdFormPengkajian'] . "/" . $data['NoCM'] . "/" . $data['NoPendaftaran'] . "/" . $data['TglMasukPoli'] . "' class='btn btn-primary'><i class='fas fa-eye'></i> Lihat Form</a>";
    //             $action = "<a href='riwayatPasienUlang/" . $data['TglMasukPoli'] . "/" . $data['NoPendaftaran'] . "' target='_blank' class='btn diagnosa'><i class='fas fa-print'></i> Print</a>";
    //             if (Auth::user()->Role == '003') {
    //                 $ver = "<a href='#' data-toggle='modal' data-target='#modal_hapus' data-nopendaftaran='" . $data['NoPendaftaran'] . "' data-nocm='" . $data['NoCM'] . "' data-tanggal='" . $data['TglMasukPoli'] . "' class='btn hapus-data batal'>Batal Verifikasi</a>";
    //             }
    //         }
    //         $html .= "

    //         <tr>
    //             <td> " . $data['NoPendaftaran'] . "</td>
    //             <td> " . $data['NoCM'] . "</td>
    //             <td> " . $data['NamaLengkap'] . "</td>
    //             <td> " . $data['TglMasukPoli'] . "</td>
    //             <td data-label='Action' class='d-flex flex-row p-lg-1'>
    //             " . $lihatForm . "" . $action . "" . $ver . "
    //             </td>
    //         </tr>";
    //     }

    //     $data = [
    //         'html' => $html
    //     ];

    //     return response()->json($data);
    // }

    /**
     * Show the form for creating a new log activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function toLogging($metode = null, $fitur = null, $keterangan = null, $no_cm = null)
    {
        $getIDuser      = Auth::user()->ID;
        $getNamaUser    = Auth::user()->Nama;
        $getRole        = Auth::user()->Role;
        $getKdRuangan   = Auth::user()->KodeRuangan;

        // store log 
        if ($getIDuser != null && $metode != null) {

            $log = new Logging();
            $log->collection    = "loggings_" . date("Y-m-d");
            $log->id_user       = $getIDuser;
            $log->nama_user     = $getNamaUser;
            $log->role          = $getRole;
            $log->metode        = $metode;
            $log->fitur         = $fitur;
            $log->keterangan    = $keterangan;
            $log->NoCM          = $no_cm;
            $log->KdRuangan     = $getKdRuangan;
            $log->save();

            // $log = Logging::create([
            //     'id_user'       =>  $id_user,
            //     'nama_user'     =>  $nama_user,
            //     'role'          =>  $role,
            //     'metode'        =>  $metode,
            //     'fitur'         =>  $fitur,
            //     'keterangan'    =>  $keterangan,
            //     'NoCM'          =>  $no_cm,
            //     'KdRuangan'     =>  $KdRuangan,
            // ]);

            return $log;
        } else {
            return 'Gagal simpan log';
        }
    }
}
