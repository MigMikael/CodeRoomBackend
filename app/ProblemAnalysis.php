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
		'prob_id',
		'class',
		'package',
		'enclose',
		'attribute',
		'attribute_score',
		'method',
		'method_score',
		'code',
        'constructor'
	];

}