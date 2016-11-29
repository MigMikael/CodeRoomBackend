<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    public $timestamps = false;
    protected $table = 'method';

    protected $fillable = [
        'analysis_id',
        'access_modifier',
        'non_access_modifier',
        'return_type',
        'name',
        'parameter',
        'score',
    ];

    public function problemAnalysis()
    {
        return $this->belongsTo('App\ProblemAnalysis', 'analysis_id');
    }
}
