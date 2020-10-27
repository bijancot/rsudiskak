<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Pekerjaan extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'pekerjaan';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'pekerjaan', 'updated_at', 'deleted_at'
    ];
}
