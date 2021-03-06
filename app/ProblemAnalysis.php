<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemAnalysis extends Model {

	protected $table = 'problem_analysis';
	public $timestamps = true;

	protected $fillable = [
		'problemfile_id',
		'class',
		'package',
		'enclose',
	];

    public function problemFile()
    {
        return $this->belongsTo('App\ProblemFile', 'problemfile_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\Attribute', 'analysis_id');
    }

    public function constructors()
    {
        return $this->hasMany('App\Constructor', 'analysis_id');
    }

    public function methods()
    {
        return $this->hasMany('App\Method', 'analysis_id');
    }

    public function score()
    {
        return $this->hasOne('App\ProblemScore', 'analysis_id');
    }
}