<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemFile extends Model
{
    public $timestamps = false;
    protected $table = 'problemfile';

    protected $fillable = [
        'problem_id',
        'package',
        'filename',
        'mime',
        'code'
    ];

    public function problem()
    {
        return $this->belongsTo('App\Problem');
    }

    public function input()
    {
        return $this->hasMany('App\ProblemInput');
    }

    public function output()
    {
        return $this->hasMany('App\ProblemOutput');
    }
}
