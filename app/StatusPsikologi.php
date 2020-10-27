<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class StatusPsikologi extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'statusPsikologi';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'statusPsikologi', 'updated_at', 'deleted_at'
    ];
}
