<?php

namespace App\Http\Controllers;

use App\Student;
use Request;
use Log;
use App\Http\Requests;

class StudentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $students = Student::all();

        return view('student.index')->with('students', $students);
    }

    public function create()
    {
        return view('student.create');
    }

    public function store()
    {
        $student = Request::all();
        $student['image'] = self::getAvatarImage();
        $student = Student::create($student);
        return $student;
    }

    public function getAvatarImage()
    {
        $request = Request::create('api/image/gen_user_avatar_image', 'GET');
        $res = app()->handle($request);
        $image_id = $res->getContent();

        return $image_id;
    }

    public function getBadge($student_id)
    {
        $student = Student::where('student_id', '=', $student_id)->first();
        Log::info('**** '. $student->name);
        $badges = $student->badges()->get();
        /*foreach ($badges as $badge){
            Log::info('**** '. $badge->name);
        }*/

        return $badges;
    }
}
