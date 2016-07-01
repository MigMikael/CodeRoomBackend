<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemFile extends Model
{
    protected $table = 'problemfile';
    public $timestamps = true;

    protected $fillable = [
        'filename',
        'mime',
        'original_filename'
    ];
}
