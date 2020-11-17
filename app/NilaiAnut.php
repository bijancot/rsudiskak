<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class NilaiAnut extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'nilaiAnut';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'nilaiAnut', 'updated_at', 'deleted_at'
    ];
}
