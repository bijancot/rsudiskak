<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class HambatanEdukasi extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'hambatanEdukasi';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'hambatanEdukasi', 'updated_at', 'deleted_at'
    ];
}
