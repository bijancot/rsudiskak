<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ManajemenUser extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'user';

    protected $fillable = [
        'ID', 'Nama', 'Password', 'Role', 'KodeRuangan', 'NamaRuangan'
    ];
}
