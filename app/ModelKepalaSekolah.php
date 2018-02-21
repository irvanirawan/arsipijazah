<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelKepalaSekolah extends Model 
{

    protected $table = 'kepala_sekolah';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}