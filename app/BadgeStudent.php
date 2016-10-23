<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadgeStudent extends Model
{
    protected $table = 'badge_student';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'student_id',
        'badge_id',
        'created_at',
        'updated_at'
    ];
}
