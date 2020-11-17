<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Keluarga extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'keluarga';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'keluarga', 'updated_at', 'deleted_at'
    ];
}
