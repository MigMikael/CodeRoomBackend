<?php

namespace App\Http\Controllers;

use App\Badge;
use App\Course;
use Request;
use Log;
use App\Http\Requests;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('badge.index')->with('badges', $badges);
    }

    public function create()
    {
        return view('badge.create');
    }

    public function store()
    {
        Log::info('#### This is BadgeController');
        $input = Request::all();
        $badge = [];
        $badge['name'] = $input['name'];
        $badge['description'] = 'pass all problem in '.$input['name'];

        $course = Course::find($input['course_id']);
        $course_name = str_replace(' ', '_', $course->name);
        $lesson_name = str_replace(' ', '_', $input['name']);
        $course_color = $course->color;
        $request = Request::create('/api/image/gen_badge_image/'.$course_name.'/'.$lesson_name.'/'.$course_color, 'GET');
        $res = app()->handle($request);
        $badge['image'] = $res->getContent();

        $badge['course_id'] = $input['course_id'];
        Badge::create($badge);

        return redirect('badge');
    }

    public function getStudent($badge_id)
    {
        $badge = Badge::find($badge_id);
        Log::info('**** '.$badge->name);
        $students = $badge->students()->get();
        return $students;

        // Todo create badge view and student view
    }
}
