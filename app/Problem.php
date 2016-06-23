<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model {

	protected $table = 'problem';
	public $timestamps = true;

	public function problem()
	{
		return $this->hasMany('ProblemAnalysis');
	}

}