<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentCourse;
use App\Course;
use Request;
use Log;

use App\Http\Requests;

class StudentCourseController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $studentCourses = StudentCourse::all();

        return view('student_course.index')->with('studentCourses', $studentCourses);
    }

    public function create()
    {
        return view('student_course.create');
    }

    public function store()
    {
        $input = Request::all();
        StudentCourse::create($input);
        return redirect('student_course');
    }

    public function update()
    {

    }

    public function destroy($id)
    {
        
    }

    public function destroyById($student_id, $course_id)
    {
        $student = Student::where('student_id', '=', $student_id)->first();
        $studentCourse = StudentCourse::where('student_id', '=', $student->id)
            ->where('course_id', '=', $course_id)
            ->first();

        $studentCourse->delete();
    }

    public function getById($student_id)
    {
        $studentCourses = StudentCourse::where('student_id', '=', $student_id)->get();
        foreach ($studentCourses as $studentCourse) {
            //Log::info('#### student course id '. $studentCourse['course_id']);
            $course = Course::where('id', '=', $studentCourse['course_id'])->first();
            $studentCourse['course_name'] = $course['name'];
            $studentCourse['image'] = $course['image'];
        }
        return $studentCourses;
    }
}
