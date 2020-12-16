<?php

namespace App\Http\Controllers;

use App\AntrianPasien;
use App\ManajemenUser;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Auth;

class ManajemenUserController extends Controller
{
    public function index()
    {
        //get data kdruangan from api
        $client = new Client();
        for ($i = 1; $i <= 2; $i++) {
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ?page=' . $i);
            $statCode = $res->getStatusCode();
            $kdRuangan = $res->getBody()->getContents();
            $kdRuangan = json_decode($kdRuangan, true);

            $resKdRuangan[$i - 1] = $kdRuangan['data'];
        }

        //get all data user
        $dataUsers = User::whereNotNull('Status')->get();

        $data = [
            'kdRuangan' => $resKdRuangan,
            'dataUser' => $dataUsers
        ];

        return view('pages.admin.managementUser', $data);
    }
    public function store(Request $req)
    {
        $data = $req->all();

        //get data kdruangan from api
        $client = new Client();
        for ($i = 1; $i <= 2; $i++) {
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ?page=' . $i);
            $statCode = $res->getStatusCode();
            $kdRuangan = $res->getBody()->getContents();
            $kdRuangan = json_decode($kdRuangan, true);

            $resKdRuangan[$i - 1] = $kdRuangan['data'];
        }

        //set password
        $data['password'] = Hash::make("rsudiskak");

        //insert nama ruangan
        $data['NamaRuangan'] = "";
        foreach ($resKdRuangan as $index) {
            foreach ($index as $item) {
                if ($item['KdRuangan'] == $req->get('KodeRuangan')) {
                    $data['NamaRuangan'] = $item['NamaRuangan'];
                    break;
                }
            }
        }

        User::insert($data);
        return redirect('m_user')->with('isCreate', true);
    }
    public function update(Request $req)
    {
        $data = $req->all();
        $IDOld = $data['IDOld'];
        unset($data['IDOld']);

        //get data kdruangan from api
        $client = new Client();
        for ($i = 1; $i <= 2; $i++) {
            $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ?page=' . $i);
            $statCode = $res->getStatusCode();
            $kdRuangan = $res->getBody()->getContents();
            $kdRuangan = json_decode($kdRuangan, true);

            $resKdRuangan[$i - 1] = $kdRuangan['data'];
        }

        //set nama ruangan
        $data['NamaRuangan'] = "";
        foreach ($resKdRuangan as $index) {
            foreach ($index as $item) {
                if ($item['KdRuangan'] == $req->get('KodeRuangan')) {
                    $data['NamaRuangan'] = $item['NamaRuangan'];
                    break;
                }
            }
        }

        User::where('ID', $IDOld)->update($data);
        return redirect('m_user')->with('isUpdate', true);
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
    // public function delete(Request $req)
    // {
    //     User::where('ID', $req->get('ID_hapus'))->update(['Status' => null]);
    //     return redirect('m_user');
    // }
    public function destroy(Request $req)
    {
        User::where('ID', $req->get('ID_hapus'))->delete();
        return redirect('m_user')->with('isDelete', true);
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

        $logging        = new LoggingController;

        if (Auth::user()->Role != "3") {
            $logging->toLogging('Logout', 'Logout', 'Telah Logout', null);
        }

        Auth::logout();
        return redirect('/login');
    }

    public function checkIdDuplicate(Request $req){
        //get data user
        $data = User::where('ID', $req->get('val'))->get();
        if(empty($data[0])){
            $res['status'] = false;
            $res['ID'] = null;
        }else{
            $res['status'] = true;
            $res['ID'] = $data[0]['ID'];
        }

        return response()->json($res);
    }
}
