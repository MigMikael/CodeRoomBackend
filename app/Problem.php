<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model {

	protected $table = 'problem';
	public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'evaluator',
        'timelimit',
        'memorylimit',
        'lesson_id',
        'code',
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function problemAnalysis()
    {
        return $this->hasMany('App\ProblemAnalysis');
    }

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }
}