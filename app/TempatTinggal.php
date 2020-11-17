<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TempatTinggal extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'tempatTinggal';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'tempatTinggal', 'updated_at', 'deleted_at'
    ];
}
