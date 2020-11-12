<?php

namespace App\Http\Controllers;

use App\ManajemenUser;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    public function index(){
        //get data kdruangan from api
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ');
        $statCode = $res->getStatusCode();
        $kdRuangan = $res->getBody()->getContents();
        $kdRuangan = json_decode($kdRuangan, true);
        $kdRuangan = $kdRuangan['data'];

        //get all data user
        $dataUsers = ManajemenUser::whereNotNull('Status')->get();
        
        $data = [
            'kdRuangan' => $kdRuangan,
            'dataUser' => $dataUsers
        ];

        return view('pages.admin.managementUser', $data);
    }
    public function store(Request $req){
        $data = $req->all();

        //get data kdruangan from api
        $client = new Client();
        $res = $client->request('GET', 'http://simrs.dev.rsudtulungagung.com/api/simrs/rj/v1/ruanganRJ');
        $statCode = $res->getStatusCode();
        $kdRuangan = $res->getBody()->getContents();
        $kdRuangan = json_decode($kdRuangan, true);
        $kdRuangan = $kdRuangan['data'];
        
        //set password
        $data['Password'] = Hash::make("rsudiskak");

        //set nama ruangan
        $data['NamaRuangan'] = "";
        foreach($kdRuangan as $item){
            if($item['KdRuangan'] == $req->get('KodeRuangan')){
                $data['NamaRuangan'] = $item['NamaRuangan'];
                break;
            }
        }

        ManajemenUser::insert($data);
        return redirect('m_user');
    }
    public function update(Request $req){
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
        foreach($kdRuangan as $item){
            if($item['KdRuangan'] == $req->get('KodeRuangan')){
                $data['NamaRuangan'] = $item['NamaRuangan'];
                break;
            }
        }

        ManajemenUser::where('ID', $IDOld)->update($data);
        return redirect('m_user');
    }
    public function getData(Request $req){
        //get data user by id
        $data = ManajemenUser::where('ID', $req->get('ID'))->get();
        $data = (!empty($data[0]) ? $data[0] : "Data Tidak Ditemukan");

        return response()->json($data);
    }

    public function resetPassword(Request $req){
        $pass = Hash::make('rsudiksak');
        ManajemenUser::where('ID', $req->get('ID_reset'))->update(['Password' => $pass]);
        return redirect('m_user');
    }
    public function delete(Request $req){
        ManajemenUser::where('ID', $req->get('ID_hapus'))->update(['Status' => null]);
        return redirect('m_user');
    }
    public function ubahPassword(){
        return view('pages.ubahPassword');
    }
    public function updatePassword(Request $req){
        ManajemenUser::where('ID', $req->get('ID'))->update(['Password' => Hash::make($req->get('password'))]);
        return response()->json($req);
    }
}
