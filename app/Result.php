<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model {

	protected $table = 'result';
	public $timestamps = true;

	protected $fillable = [
		'submissionfile_id',
		'class',
		'package',
		'enclose',
	];

    public function submissionFile()
    {
        return $this->belongsTo('App\SubmissionFile', 'submissionfile_id');
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

    public function score()
    {
        return $this->hasOne('App\ResultScore', 'result_id');
    }
}