<?php

namespace App;

use App\Http\Controllers\DiagnosaController;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AntrianPasien extends Eloquent
{
    protected $connection = 'mongodb';
    public $collection;

    protected $guarded = [];
}
