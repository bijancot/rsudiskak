<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ICD10 extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'ICD10';

    protected $guarded = [];
}
