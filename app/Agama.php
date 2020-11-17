<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Agama extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'agama';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'agama', 'updated_at', 'deleted_at'
    ];
}
