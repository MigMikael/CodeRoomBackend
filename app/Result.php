<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model {

	protected $table = 'result';
	public $timestamps = true;

	protected $fillable = [
		'submission_id',
		'class',
		'package',
		'enclose',
	];

    public function submission()
    {
        return $this->belongsTo('App\Submission');
    }

    public function attributes()
    {
        return $this->hasMany('App\ResultAttribute', 'result_id');
    }

    public function constructors()
    {
        return $this->hasMany('App\ResultConstructor', 'result_id');
    }

    public function methods()
    {
        return $this->hasMany('App\ResultMethod', 'result_id');
    }
}