<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemAnalysis extends Model {

	protected $table = 'problem_analysis';
	public $timestamps = true;

	public function output()
	{
		return $this->hasMany('OutputCirteria');
	}

	protected $fillable = [
		'problem_id',
		'class',
		'package',
		'enclose',
		'attribute',
		'method',
		'code',
        'constructor'
	];

    public function problem()
    {
        return $this->belongsTo('App\Problem');
    }

    public function problemStructureScore()
    {
        return $this->hasOne('App\ProblemStructureScore', 'analysis_id');
    }

}