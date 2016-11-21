<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionFile extends Model
{
    public $timestamps = false;
    protected $table = 'submissionfile';

    protected $fillable = [
        'submission_id',
        'package',
        'filename',
        'mime',
        'code'
    ];

    public function submission()
    {
        return $this->belongsTo('App\Submission');
    }
}
