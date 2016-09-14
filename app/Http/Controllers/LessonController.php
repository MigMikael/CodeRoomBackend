<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use App\Lesson;
use App\Problem;
use Request;
use Log;
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

    public function getProblem($lesson_id)
    {
        $problems = Problem::where('lesson_id', '=', $lesson_id)->get();
        foreach ($problems as $problem){
            $problem->code = '';
        }
        return $problems;
    }
}
