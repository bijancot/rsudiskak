<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Pendidikan extends Eloquent
{

    protected $connection = 'mongodb';
    protected $collection = 'pendidikan';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'pendidikan', 'updated_at', 'deleted_at'
    ];
}
