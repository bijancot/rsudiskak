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
        if(Auth::user()->status == "003"){
            return redirect()->route('admin');
        }

        //perawat
        if(Auth::user()->status == "002"){
            return $next($request);
        }

        //dokter
        if(Auth::user()->status == "001"){
            return redirect()->route('dokter');
        }
    }
}
