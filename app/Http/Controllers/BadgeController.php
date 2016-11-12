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

    // Store Normal badge
    public function store()
    {
        $badge = Request::all();
        $badge['type'] = 'normal_badge';
        $badge['image'] = self::getBadgeImage($badge);
        Badge::create($badge);

        return redirect('badge');
    }

    // Store Lesson badge
    public function genLessonBadge()
    {
        Log::info('#### This is BadgeController');

        $lesson = Request::all();
        $badge = [];
        $badge['name'] = $lesson['name'];
        $badge['description'] = 'Correct all problem in '.$lesson['name'];
        $badge['course_id'] = $lesson['course_id'];
        $badge['type'] = 'lesson_badge';
        $badge['image'] = self::getBadgeImage($badge);
        Badge::create($badge);

        return 'gen finish';
    }

    public function getBadgeImage($badge)
    {
        $course = Course::find($badge['course_id']);
        $course_name = str_replace(' ', '_', $course->name);
        $course_color = $course->color;
        $request = null;

        if($badge['type'] == 'lesson_badge'){
            $lesson_name = str_replace(' ', '_', $badge['name']);
            $request = Request::create('/api/image/gen_lesson_badge_image/'.$course_name.'/'.$lesson_name.'/'.$course_color, 'GET');
        }
        elseif ($badge['type'] == 'normal_badge'){
            $criteria = $badge['criteria'];
            $request = Request::create('/api/image/gen_normal_badge_image/'.$course_name.'/'.$criteria.'/'.$course_color, 'GET');
        }
        $res = app()->handle($request);
        $image_id = $res->getContent();

        return $image_id;
    }


    public function getStudent($badge_id)
    {
        $badge = Badge::find($badge_id);
        Log::info('**** '.$badge->name);
        $students = $badge->students()->get();
        return $students;

        // Todo create student view
    }
}
