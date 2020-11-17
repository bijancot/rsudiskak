<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logging;

class LoggingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function toLogging($id_user = null, $nama_user = null, $role = null, $metode = null, $fitur = null, $keterangan = null, $no_cm = null, $KdRuangan = null)
    {
        // store log 
        if ($id_user != null && $metode != null) {

            $log = new Logging();
            $log->collection    = "loggings_" . date("Y-m-d");
            $log->id_user       = $id_user;
            $log->nama_user     = $nama_user;
            $log->role          = $role;
            $log->metode        = $metode;
            $log->fitur         = $fitur;
            $log->keterangan    = $keterangan;
            $log->NoCM          = $no_cm;
            $log->KdRuangan     = $KdRuangan;
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
