<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultMethod extends Model
{
    public $timestamps = false;
    protected $table = 'result_method';

    protected $fillable = [
        'result_id',
        'access_modifier',
        'non_access_modifier',
        'return_type',
        'name',
        'parameter',
        'score',
    ];

    public function problemAnalysis()
    {
        return $this->belongsTo('App\Result', 'result_id');
    }
}
