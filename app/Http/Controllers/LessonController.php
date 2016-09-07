<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use App\Lesson;
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

    public function getById($course_id)
    {
        $course = Course::where('id', '=', $course_id)->first();
        $lessons = Lesson::where('course_id', '=', $course_id)->orderBy('order')->get();
        $announcements = Announcement::where('course_id', '=', $course_id)->get();
        $course['lessons'] = $lessons;
        $course['announcement'] = $announcements;
        return $course;
    }
}
