<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemInput extends Model
{
    public $timestamps = false;
    protected $table = 'problem_input';

    protected $fillable = [
        'problemfile_id',
        'version',
        'filename',
        'content',
    ];

    public function problemFile()
    {
        return $this->belongsTo('App\ProblemFile', 'problemfile_id');
    }
}
