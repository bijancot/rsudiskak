<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Perawat
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
        if(Auth::user()->KdJabatan == "3"){
            return redirect()->route('admin');
        }

        //perawat
        if(Auth::user()->KdJabatan == "2"){
            return $next($request);
        }

        //dokter
        if(Auth::user()->KdJabatan == "1"){
            return redirect()->route('dokter');
        }
    }
}
