<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ICD09 extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'ICD09';

    protected $guarded = [];
}
