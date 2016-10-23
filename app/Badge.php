<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $table = 'badge';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    // badge is owned by user
    public function students()
    {
        return $this->belongsToMany('App\Student', 'badge_student', 'badge_id', 'student_id');
    }
}
