<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelNilai extends Model 
{

    protected $table = 'nilai';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}