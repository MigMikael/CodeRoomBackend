<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'prob_id',
        'class',
        'attribute',
        'method'
    ];
}
