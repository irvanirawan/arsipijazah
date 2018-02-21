<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasModel extends Model 
{

    protected $table = 'kelas';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}