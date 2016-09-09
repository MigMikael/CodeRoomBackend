<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use App\Lesson;
use App\StudentCourse;
use App\StudentLesson;
use Request;
use Log;
use DB;
use App\Http\Requests;

class CourseController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $courses = Course::all();
        return view('course.index')->with('courses', $courses);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store()
    {
        $input = Request::all();
        Course::create($input);
        return redirect('course');
    }

    public function getAll()
    {
        $courses = Course::all();
        return $courses;
    }

    public function getDetail($course_id, $student_id)
    {
        $course = Course::where('id', '=', $course_id)->first();
        $lessons = Lesson::where('course_id', '=', $course_id)->orderBy('order')->get();
        $lessonNum = Lesson::where('course_id', '=', $course_id)->orderBy('order')->count();
        $announcements = Announcement::where('course_id', '=', $course_id)->get();

        $student_course = StudentCourse::where([
            ['student_id', '=', $student_id],
            ['course_id', '=', $course_id]
        ])->first();
        $student_course_id = $student_course->id;

        $lessons_progress = StudentLesson::where('student_course_id', '=', $student_course_id)->get();
        $size = sizeof($lessons_progress);

        for ($i = 0; $i < sizeof($lessons); $i++){
            if($size > 0) {
                $lessons[$i]['progress'] = $lessons_progress[$i]['progress'];
            }else{
                $lessons[$i]['progress'] = 0;
            }
            $size--;
        }

        $course['lesson_num'] = $lessonNum;
        $course['lessons'] = $lessons;
        $course['announcement'] = $announcements;

        return $course;
    }
}
