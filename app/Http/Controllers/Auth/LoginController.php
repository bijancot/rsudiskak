<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/listPasien';

    public function redirectTo()
    {
        // set status login
        User::where('ID', Auth::user()->ID)->whereNotNull('Status')->update(['StatusLogin' => '1']);
        switch (Auth::user()->Role) {
            case '1':
                $this->redirectTo = '/listPasien';
                return $this->redirectTo;
                break;
            case '2':
                $this->redirectTo = '/listPasien';
                return $this->redirectTo;
                break;
            case '3':
                $this->redirectTo = '/logActivities';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
                break;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
