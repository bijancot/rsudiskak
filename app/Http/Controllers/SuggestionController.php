<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function getSgsAnamnesis(Request $req){
        $datas = DB::collection('sgsAnamnesis')->where('kdRuangan', '215')->orderBy('freqSelected', 'desc')->get();
        return response()->json($datas);
    }
    public function storeSgsAnamnesis(Request $req) {
        $suggest = DB::collection('sgsAnamnesis')->where('name', $req['suggest'])->first();
        if($suggest != null){
            DB::collection('sgsAnamnesis')->where('_id', $suggest['_id'])->update(['freqSelected' => $suggest['freqSelected']+1]);
        }else{
            DB::collection('sgsAnamnesis')->insert(['name' => $req['suggest'], 'freqSelected' => 1, 'kdRuangan' => "215"]);
        }
    }
}
