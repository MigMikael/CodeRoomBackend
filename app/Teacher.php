<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher';
    public $timestamps = true;

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'name',
        'status',
        'image',
        'username',
        'password'
    ];

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'teacher_course', 'teacher_id', 'course_id')
            ->withPivot('status');
    }
}
