<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemStructureScore extends Model
{
    protected $table = 'problem_structure_score';
    public $timestamps = true;

    protected $fillable = [
        'class',
        'package',
        'enclose',
        'attribute',
        'method',
        'constructor'
    ];
}
