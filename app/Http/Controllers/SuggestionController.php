<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function getSuggestion(Request $req){
        $datas = DB::collection($req['collection'])
            ->where('kdRuangan', '215')
            ->where('name', 'LIKE', '%' . $req['keyword'] . '%')
            ->orderBy('freqSelected', 'desc')
            ->limit(10)
            ->get();
        return response()->json($datas);
    }
    public function storeSuggestion(Request $req) {
        $suggest = DB::collection($req['collection'])->where('name', $req['suggest'])->first();
        if($suggest != null){
            DB::collection($req['collection'])->where('_id', $suggest['_id'])->update(['freqSelected' => $suggest['freqSelected']+1]);
        }else{
            DB::collection($req['collection'])->insert(['name' => $req['suggest'], 'freqSelected' => 1, 'kdRuangan' => "215"]);
        }
    }
}
