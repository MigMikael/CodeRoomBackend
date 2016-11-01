<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    public $timestamps = true;

    protected $fillable = [
        'student_id',
        'name',
        'image',
    ];

    public function badges()
    {
        return $this->belongsToMany('App\Badge', 'badge_student', 'student_id', 'badge_id');
    }
}
