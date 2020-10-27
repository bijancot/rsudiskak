<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ManajemenForm extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'manajemenForm';

    // protected $guarded = [];
    protected $fillable = [
        'id', 'idForm', 'namaForm',  'namaFile', 'updated_at', 'deleted_at'
    ];
}
