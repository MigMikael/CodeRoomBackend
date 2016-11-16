<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemStructureScore extends Model
{
    protected $table = 'problem_structure_score';
    public $timestamps = true;

    protected $fillable = [
        'analysis_id',
        'class',
        'package',
        'enclose',
        'attribute',
        'method',
        'constructor'
    ];

    public function problemAnalysis()
    {
        return $this->belongsTo('App\ProblemAnalysis', 'analysis_id');
    }
}
