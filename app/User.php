<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // protected $connection = "mongodb";
    // protected $collection = "user";
    // protected $primaryKey = 'ID';

    protected $fillable = [
        // 'IdDokter', 'NamaLengkap', 'password', 'KdRuangan', 'NamaRuangan', 'KdJabatan',
        'ID', 'Nama', 'Role', 'KodeRuangan', 'StatusLogin', 'Status', 'password', 'NamaRuangan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        // 'Password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
