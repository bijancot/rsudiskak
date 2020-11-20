<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DetailAttribute extends Eloquent
{
    protected $connection = 'mongodb';
    public $collection;

    protected $fillable = [
        'namaAttribute',  'updated_at', 'deleted_at'
    ];
}
