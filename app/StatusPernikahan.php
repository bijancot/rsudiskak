<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class StatusPernikahan extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'statusPernikahan';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'statusPernikahan', 'updated_at', 'deleted_at'
    ];
}
