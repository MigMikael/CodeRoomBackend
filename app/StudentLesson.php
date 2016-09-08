<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentLesson extends Model
{
    protected $table = 'student_lesson';
    public $timestamps = true;

    protected $fillable = [
        'student_course_id',
        'lesson_id',
        'progress'
    ];
}
