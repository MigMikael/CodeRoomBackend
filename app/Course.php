<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'instructor'
    ];
}