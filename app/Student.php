<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    public $timestamps = true;

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'student_id',
        'name',
        'email',
        'image',
        'username',
        'password',
        'token',
        'ip'
    ];

    public function badges()
    {
        return $this->belongsToMany('App\Badge', 'badge_student', 'student_id', 'badge_id');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'student_course', 'student_id', 'course_id')
            ->withPivot('status', 'progress');
    }

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }
}
