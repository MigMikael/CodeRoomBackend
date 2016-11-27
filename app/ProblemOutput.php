<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemOutput extends Model
{
    public $timestamps = false;
    protected $table = 'problem_output';

    protected $fillable = [
        'problemfile_id',
        'version',
        'filename',
        'content',
        'score',
    ];

    public function problemFile()
    {
        return $this->belongsTo('App\ProblemFile', 'problemfile_id');
    }
}
