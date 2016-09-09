<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultStructureScore extends Model
{
    protected $table = 'result_structure_score';
    public $timestamps = true;

    protected $fillable = [
        'class',
        'package',
        'enclose',
        'attribute',
        'method',
    ];
}
