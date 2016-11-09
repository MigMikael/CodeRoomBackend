<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    protected $table = 'teacher_course';
    public $timestamps = true;

    protected $fillable = [
        'teacher_id',
        'course_id',
        'status',
    ];
}
