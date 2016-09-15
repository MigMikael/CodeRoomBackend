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
        $problem_list = [];
        $problem_list['problem'] = [];
        foreach ($problems as $problem){
            $item = [];
            $item['prob_id'] = $problem->id;
            $item['name'] = $problem->name;
            $item['timelimit'] = $problem->timelimit;
            $item['memorylimit'] = $problem->memorylimit;
            $item['lesson_id'] = $problem->lesson_id;
            array_push($problem_list['problem'], $item);
        }
        $lesson_name = Lesson::where('id', '=', $lesson_id)->value('name');
        $problem_list['lesson_name'] = $lesson_name;
        return $problem_list;
    }
}
