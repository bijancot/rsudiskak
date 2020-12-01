<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class Dokter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        
        //admin
        if(Auth::user()->Role== "3"){
            return redirect()->route('logActivities');
        }

        //perawat
        if(Auth::user()->Role == "2"){
            return redirect()->route('listPasien');
        }

        //dokter
        if(Auth::user()->Role == "1"){
            return $next($request);
        }
    }
}
