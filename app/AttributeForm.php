<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AttributeForm extends Eloquent
{
    protected $connection = 'mongodb';
    public $collection;

    protected $fillable = [
        'namaAttribute',  'namaCollection', 'updated_at', 'deleted_at'
    ];
}
