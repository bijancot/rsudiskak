<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ICD09Controller;
use App\Http\Controllers\ICD10Controller;
use App\Http\Controllers\LoggingController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Cookie;

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

        $logging        = new LoggingController;

        switch (Auth::user()->Role) {
            case '1':

                $logging->toLogging('Login', 'Login', 'Telah Login', null);
                $this->redirectTo = '/listPasien';
                return $this->redirectTo;
                break;

            case '2':

                // $kue09 = Cookie::get('ICD9');

                // if (empty($kue09)) {
                //     $this->redirectTo = '/setCookiesICD09';
                //     return $this->redirectTo;
                //     break;
                // }

                $logging->toLogging('Login', 'Login', 'Telah Login', null);
                $this->redirectTo = '/listPasien';
                return $this->redirectTo;
                break;


            case '3':

                $this->redirectTo = '/logActivities';
                return $this->redirectTo;
                break;

            default:
                // $this->redirectTo = '/login';
                // return $this->redirectTo;
                break;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        // $kue09 = Cookie::get('ICD9');
        // $kue10 = Cookie::get('ICD10');

        // $ICD09          = new ICD09Controller;
        // $ICD10          = new ICD10Controller;

        // if (!empty($kue09) && !empty($kue10)) {
        //     Cookie::get('ICD9');
        //     // Cookie::get('ICD10');
        //     // $this->redirectTo = '/getCookiesICD09';
        //     // return $this->redirectTo;
        // } else {
        //     $ICD09->setICD09($kue09);
        //     echo "aaa";
        //     // $ICD10->setICD10($kue10);
        //     // $this->redirectTo = '/setCookiesICD09';
        //     // return $this->redirectTo;
        // }

        $this->middleware('guest')->except('logout');
    }
}
