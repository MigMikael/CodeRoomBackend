<?php

namespace App\Http\Controllers;

use App\Lesson;
use Request;

use App\Http\Requests;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();
        return view('lesson.index')->with('lessons', $lessons);
    }

    public function create()
    {
        return view('lesson.create');
    }

    public function store()
    {
        $input = Request::all();
        Lesson::create($input);
        return redirect('lesson');
    }

    public function getById($course_id)
    {
        $lessons = Lesson::where('course_id', '=', $course_id)->get();
        return $lessons;
    }
}
