<?php

namespace App\Http\Controllers;

use App\ManajemenUser;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Auth;

class ManajemenUserController extends Controller
{
    public function index()
    {
        //get data kdruangan from api
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ');
        $statCode = $res->getStatusCode();
        $kdRuangan = $res->getBody()->getContents();
        $kdRuangan = json_decode($kdRuangan, true);
        $kdRuangan = $kdRuangan['data'];

        //get all data user
        $dataUsers = User::whereNotNull('Status')->get();

        $data = [
            'kdRuangan' => $kdRuangan,
            'dataUser' => $dataUsers
        ];

        return view('pages.admin.managementUser', $data);
    }
    public function store(Request $req)
    {
        $data = $req->all();

        //get data kdruangan from api
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ');
        $statCode = $res->getStatusCode();
        $kdRuangan = $res->getBody()->getContents();
        $kdRuangan = json_decode($kdRuangan, true);
        $kdRuangan = $kdRuangan['data'];

        //set password
        $data['password'] = Hash::make("rsudiskak");

        //set nama ruangan
        $data['NamaRuangan'] = "";
        foreach ($kdRuangan as $item) {
            if ($item['KdRuangan'] == $req->get('KodeRuangan')) {
                $data['NamaRuangan'] = $item['NamaRuangan'];
                break;
            }
        }

        User::insert($data);
        return redirect('m_user');
    }
    public function update(Request $req)
    {
        $data = $req->all();
        $IDOld = $data['IDOld'];
        unset($data['IDOld']);

        //get data kdruangan from api
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ');
        $statCode = $res->getStatusCode();
        $kdRuangan = $res->getBody()->getContents();
        $kdRuangan = json_decode($kdRuangan, true);
        $kdRuangan = $kdRuangan['data'];

        //set nama ruangan
        $data['NamaRuangan'] = "";
        foreach ($kdRuangan as $item) {
            if ($item['KdRuangan'] == $req->get('KodeRuangan')) {
                $data['NamaRuangan'] = $item['NamaRuangan'];
                break;
            }
        }

        User::where('ID', $IDOld)->update($data);
        return redirect('m_user');
    }
    public function getData(Request $req)
    {
        //get data user by id
        $data = User::where('ID', $req->get('ID'))->get();
        $data = (!empty($data[0]) ? $data[0] : "Data Tidak Ditemukan");

        return response()->json($data);
    }

    public function resetPassword(Request $req)
    {
        $pass = Hash::make('rsudiskak');
        User::where('ID', $req->get('ID_reset'))->update(['password' => $pass]);
        return redirect('m_user');
    }
    public function delete(Request $req)
    {
        User::where('ID', $req->get('ID_hapus'))->update(['Status' => null]);
        return redirect('m_user');
    }
    public function ubahPassword()
    {
        return view('pages.ubahPassword');
    }
    public function lupaPassword()
    {
        return view('pages.lupaPassword');
    }
    public function updatePassword(Request $req)
    {
        User::where('ID', $req->get('ID'))->update(['password' => Hash::make($req->get('password'))]);
        return response()->json('berhasil');
    }
    public function signOut(Request $req)
    {
        // set status login
        User::where('ID', Auth::user()->ID)->whereNotNull('Status')->update(['StatusLogin' => '0']);
        $getIDuser      = Auth::user()->ID;
        $getNamaUser    = Auth::user()->Nama;
        $getRole        = Auth::user()->Role;
        $getKdRuangan   = Auth::user()->KodeRuangan;

        $logging        = new LoggingController;
        if (Auth::user()->getRole != 3) {
            $logging->toLogging($getIDuser, $getNamaUser, $getRole, 'Logout', 'Logout', 'Telah Logout', null, $getKdRuangan);
        }
        Auth::logout();
        return redirect('/login');
    }
}
