<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    public $timestamps = true;

    protected $fillable = [
        'height',
        'width',
        'background_color',
        'foreground_color',
        'text',
        'type',
    ];
}
