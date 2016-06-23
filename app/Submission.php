<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model {

	protected $table = 'submission';
	public $timestamps = true;

	public function result()
	{
		return $this->hasMany('Result');
	}

	protected $fillable = [
		'user_id',
		'prob_id',
		'sub_num',
		'time',
		'code'
	];

	public function setTimeAttribute($date)
	{
		$this->attributes['time'] = Carbon::createFromFormat('Y-m-d', $date);
	}

}