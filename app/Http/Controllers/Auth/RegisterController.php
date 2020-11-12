<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'IdDokter' => ['required', 'string', 'max:255'],
            'NamaLengkap' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'KdRuangan' => ['required', 'string', 'max:255'],
            'NamaRuangan' => ['required', 'string', 'max:255'],
            'KdJabatan' => ['required', 'string', 'max:255'],
            // 'ID' => ['required', 'string', 'max:255'],
            // 'Nama' => ['required', 'string', 'max:255'],
            // 'Password' => ['required', 'string'],
            // 'KodeRuangan' => ['required', 'string', 'max:255'],
            // 'NamaRuangan' => ['required', 'string', 'max:255'],
            // 'Role' => ['required', 'string', 'max:255'],
            // 'StatusLogin' => ['required', 'string', 'max:255'],
            // 'Status' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'IdDokter' => $data['IdDokter'],
            'NamaLengkap' => $data['NamaLengkap'],
            'KdRuangan' => $data['KdRuangan'],
            'NamaRuangan' => $data['NamaRuangan'],
            'KdJabatan' => $data['KdJabatan'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
