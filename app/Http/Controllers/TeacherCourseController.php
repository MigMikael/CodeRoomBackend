<?php

namespace App\Http\Controllers;

use App\TeacherCourse;
use Request;
use App\Course;
use App\Http\Requests;

class TeacherCourseController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $teacherCourses = TeacherCourse::all();

        return view('teacher_course.index')->with('teacherCourses', $teacherCourses);
    }

    public function create()
    {
        return view('teacher_course.create');
    }

    public function store()
    {
        $input = Request::all();
        TeacherCourse::create($input);
        return redirect('teacher_course');
    }

    public function getById($teacher_id)
    {
        $teacherCourses = TeacherCourse::where('teacher_id', '=', $teacher_id)->get();
        foreach ($teacherCourses as $teacherCourse) {
            //Log::info('#### student course id '. $studentCourse['course_id']);
            $course = Course::where('id', '=', $teacherCourse['course_id'])->first();
            $teacherCourse['course_name'] = $course['name'];
            $teacherCourse['image'] = $course['image'];
        }
        return $teacherCourses;
    }
}
