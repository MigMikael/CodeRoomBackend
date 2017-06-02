<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Teacher;
use App\Http\Requests;

class AdminController extends Controller
{
    public function dashboard()
    {
        $courses = $courses = Course::withCount([
            'students', 'teachers', 'lessons'
        ])->get();
        foreach ($courses as $c){
            $c->makeHidden('token');
            foreach ($c->students as $student){
                $student->makeHidden('token');
            }

            foreach ($c->teachers as $teacher){
                $teacher->makeHidden('token');
            }
            $c->lessons;
            $c->announcement;
            $c->badges;
        }
        $teachers = Teacher::all()->makeHidden('token');

        $data['courses'] = $courses;
        $data['teacher'] = $teachers;
        return $data;
    }
}
