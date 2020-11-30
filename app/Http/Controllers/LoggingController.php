<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logging;
use Illuminate\Support\Facades\Auth;

class LoggingController extends Controller
{
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
        $listLog                = $logging->get();
        $data = [
            'listLog' => $listLog
        ];

        return view('pages.admin.logActivities', $data);
    }

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
