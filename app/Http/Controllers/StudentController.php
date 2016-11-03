<?php

namespace App\Http\Controllers;

use Excel;
use App\Student;
use App\StudentCourse;
use Request;
use Log;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

    public function storeOneStudentMember()
    {
        $course_id = Request::get('course_id');
        $student_id = Request::get('student_id');
        $name = Request::get('name');

        $student = [
            'student_id' => $student_id,
            'name' => $name,
            'image' => self::getAvatarImage(),
        ];
        $student = Student::create($student);

        $studentCourse = [
            'student_id' => $student->id,
            'course_id' => $course_id
        ];
        StudentCourse::create($studentCourse);

        return 'add student complete';
    }

    public function storeManyStudentMember()
    {
        $course_id = Request::get('course_id');
        $studentListFile = Request::file('studentList');

        $fileName = $studentListFile->getClientOriginalName();
        Storage::disk('public')->put($fileName, File::get($studentListFile));
        $path = storage_path().'\\app\\public\\' . $fileName;
        $data = Excel::load($path, function ($reader){

        })->get();

        $students = [];
        if(!empty($data) && $data->count()){
            foreach ($data as $key => $value) {
                $students[] = ['student_id' => $value->id, 'name' => $value->name];
                //Log::info('###### '. $value->student_id.' '.$value->name);
            }
            if(empty($students)){
                return 'error in data File';
            }
        }

        foreach ($students as $student){
            $student['image'] = self::getAvatarImage();
            $student = Student::create($student);

            $studentCourse = [
                'student_id' => $student->id,
                'course_id' => $course_id
            ];
            StudentCourse::create($studentCourse);
        }

        return 'add student complete';
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

    public function getStudentProfile($student_id)
    {
        $student = Student::withCount('courses')
            ->withCount('badges')
            ->where('student_id', '=', $student_id)
            ->first();
        $student->badges;
        return $student;
    }
}
