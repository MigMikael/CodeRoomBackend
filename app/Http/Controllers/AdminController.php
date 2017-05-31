<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function dashboard()
    {
        $courses = $courses = Course::withCount([
            'students', 'teachers', 'lessons'
        ])->get();
        foreach ($courses as $c){
            $c->students;
            $c->teachers;
            $c->lessons;
            $c->announcement;
            $c->badges;
        }
        return $courses;
    }
}
