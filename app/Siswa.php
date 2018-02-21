<?php

namespace siswaModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model 
{

    protected $table = 'siswa';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}