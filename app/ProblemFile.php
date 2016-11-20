<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemFile extends Model
{
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
}
