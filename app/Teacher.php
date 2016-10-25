<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'status'
    ];
}
