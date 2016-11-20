<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultAttribute extends Model
{
    protected $table = 'result_attribute';

    protected $fillable = [
        'result_id',
        'access_modifier',
        'non_access_modifier',
        'data_type',
        'name',
        'score',
    ];

    public function result()
    {
        return $this->belongsTo('App\Result', 'result_id');
    }
}
