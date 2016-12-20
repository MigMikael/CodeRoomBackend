<?php

namespace App\Http\Controllers;

use App\BadgeStudent;
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
        //return $students;
        return view('student.index')->with('students', $students);
    }

    public function create()
    {
        return view('student.create');
    }

    public function store()
    {
        $password = Request::get('password');
        $confirmPassword = Request::get('confirm_password');
        if($password != $confirmPassword){
            return 'password not match';
        }

        $student = [
            'student_id' => Request::get('student_id'),
            'name' => Request::get('name'),
            'username' => Request::get('username'),
            'password' => bcrypt($password),
        ];
        $student = Student::firstOrCreate($student);
        if($student->image == ''){
            $student->image = self::getAvatarImage();
            $student->save();
        }
        return $student;
    }

    public function show($id)
    {
        $student = Student::withCount([
            'courses', 'badges', 'submissions'
        ])->findOrFail($id);

        foreach ($student->courses as $course){
            $course->pivot;
        }
        $student->badges;
        foreach ($student->submissions as $submission){
            $submission->code = '';
        }

        return view('student.show')->with('student', $student);
        //return $student;
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('student.edit')->with('student', $student);
    }

    public function update($id)
    {
        // Todo now Cannot change password
        $student = Student::findOrFail($id);

        $newStudent = [
            'name' => Request::get('name'),
            'student_id' => Request::get('student_id'),
            'username' => Request::get('username'),
        ];
        $student->update($newStudent);

        return redirect('student');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return 'Delete Finish';
    }

    public function storeOneStudentMember()
    {
        $course_id = Request::get('course_id');
        $student_id = Request::get('student_id');
        $name = Request::get('name');

        $student = [
            'student_id' => $student_id,
            'name' => $name,
        ];
        $student = Student::firstOrCreate($student);
        if($student->image == ''){
            $student->image = self::getAvatarImage();
            $student->username = $student->student_id;  // auto generate username & pass from student_id ex. 07560550
            $student->password = bcrypt($student->student_id);
            $student->save();
        }

        $studentCourse = [
            'student_id' => $student->id,
            'course_id' => $course_id,
            'status' => 'active',
        ];
        StudentCourse::firstOrCreate($studentCourse);

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
            $student = Student::firstOrCreate($student);
            if($student->image == ''){
                $student->image = self::getAvatarImage();
                $student->username = $student->student_id;
                $student->password = bcrypt($student->student_id);
                $student->save();
            }

            $studentCourse = [
                'student_id' => $student->id,
                'course_id' => $course_id,
                'status' => 'active',
            ];
            StudentCourse::firstOrCreate($studentCourse);
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

    public function changeStatus($student_id, $course_id)
    {
        $studentCourse = StudentCourse::where([
            ['student_id', '=', $student_id],
            ['course_id', '=', $course_id]
        ])->first();

        if($studentCourse->status == 'active'){
            $studentCourse->status = 'inactive';
        }else{
            $studentCourse->status = 'active';
        }
        $studentCourse->save();

        return back();
    }

    public function deleteBadge($student_id, $badge_id)
    {
        $badgeStudent = BadgeStudent::where([
            ['student_id', '=', $student_id],
            ['badge_id', '=', $badge_id]
        ])->first();

        $badgeStudent->delete();
        return back();
    }

}
