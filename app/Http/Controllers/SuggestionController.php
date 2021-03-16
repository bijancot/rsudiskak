<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function getSuggestion(Request $request)
    {
        $getKdRuangan   = Auth::user()->KodeRuangan;
        $datas = DB::collection($request['collection'])
            ->where('kdRuangan', $getKdRuangan)
            ->where('name', 'LIKE', '%' . $request['keyword'] . '%')
            ->orderBy('freqSelected', 'desc')
            ->limit(10)
            ->get();
        return response()->json($datas);
    }
    public function storeSuggestion(Request $request)
    {
        $getKdRuangan   = Auth::user()->KodeRuangan;
        $suggest = DB::collection($request['collection'])->where('name', $request['suggest'])->first();
        if ($suggest != null) {
            DB::collection($request['collection'])->where('_id', $suggest['_id'])->update(['freqSelected' => $suggest['freqSelected'] + 1]);
        } else {
            DB::collection($request['collection'])->insert(['name' => $request['suggest'], 'freqSelected' => 1, 'kdRuangan' => $getKdRuangan]);
        }
    }
}
