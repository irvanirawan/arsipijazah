<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelWalikelas extends Model 
{

    protected $table = 'walikelas';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}