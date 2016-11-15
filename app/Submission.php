<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model {

	protected $table = 'submission';
	public $timestamps = true;

	protected $fillable = [
		'student_id',
		'problem_id',
		'sub_num',
		'code'
	];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function problem()
    {
        return $this->belongsTo('App\Problem');
    }
}