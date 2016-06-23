<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model {

	protected $table = 'result';
	public $timestamps = true;

	public function output()
	{
		return $this->hasMany('OutputScore');
	}

	protected $fillable = [
		'submission_id',
		'class',
		'package',
		'enclose',
		'attribute',
		'attribute_score',
		'method',
		'method_score'
	];

}