<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Logging extends Eloquent
{
    protected $connection = 'mongodb';
    public $collection;

    // protected $guarded = [];
    protected $fillable = [
        'id_user', 'nama_user', 'role', 'metode', 'fitur', 'keterangan', 'NoCM', 'KdRuangan'
    ];
}
