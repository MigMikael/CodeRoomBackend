<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionOutput extends Model
{
    public $timestamps = false;
    protected $table = 'submission_output';

    protected $fillable = [
        'submissionfile_id',
        'content',
        'score',
    ];

    public function submissionFile()
    {
        return $this->belongsTo('App\SubmissionFile', 'submissionfile_id');
    }
}
