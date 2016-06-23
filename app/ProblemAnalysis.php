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

}