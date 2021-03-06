<?php

namespace App\Http\Controllers;

use App\BadgeStudent;
use App\Course;
use App\Helper\TokenGenerate;
use App\StudentLesson;
use Excel;
use App\Student;
use App\StudentCourse;
//use Request;
use Log;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

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

        if($studentCourse->status == 'enable'){
            $studentCourse->status = 'disable';
        }else{
            $studentCourse->status = 'enable';
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


    #--------------------------------------------------------------------------------------------------------

    public function dashboard(Request $request)
    {
        /*if(!($request->session()->has('userID'))){
            return response()->json(['status' => 'session expire']);
        }*/

        $userID = $request->session()->get('userID');
        //$userRole = $request->session()->get('userRole');

        $student = Student::findOrFail($userID);
        $student['courses'] = $student->courses()->withCount([
            'students', 'teachers', 'lessons',
        ])->get();

        $data = [];
        $data['student'] = $student;

        $courses = Course::withCount([
            'students', 'teachers', 'lessons'
        ])->get();
        $data['courses'] = $courses;

        return $data;
    }

    public function showStudent($id)
    {
        $student = Student::findOrFail($id);
        return $student;
    }

    public function disableStudent($student_id, $course_id)
    {
        $student_course = StudentCourse::where([
            ['student_id', '=', $student_id],
            ['course_id', '=', $course_id]
        ])->first();

        if($student_course->status == 'enable'){
            $student_course->status = 'disable';
        }else{
            $student_course->status = 'enable';
        }
        $student_course->save();

        return response()->json(['msg' => 'success']);
    }

    public function addStudentMember()
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
            $student->token = (new TokenGenerate())->generate(32);
            $student->username = $student->student_id;  // auto generate username & pass from student_id ex. 07560550
            $student->password = password_hash($student_id, PASSWORD_DEFAULT);
            $student->save();
        }

        $studentCourse = [
            'student_id' => $student->id,
            'course_id' => $course_id,
            'status' => 'enable',
        ];
        StudentCourse::firstOrCreate($studentCourse);

        return response()->json(['msg' => 'success']);
    }

    public function addStudentMembers(Request $request)
    {
        $course_id = $request->get('course_id');
        $studentListFile = $request->file('studentList');

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

        $token = new TokenGenerate();
        foreach ($students as $student){
            $student = Student::firstOrCreate($student);
            if($student->image == ''){
                $student->image = self::getAvatarImage();
                $student->username = $student->student_id;
                $student->password = bcrypt($student->student_id);
                $student->token = $token->generate(10);
                $student->save();
            }

            $studentCourse = [
                'student_id' => $student->id,
                'course_id' => $course_id,
                'status' => 'active',
            ];
            StudentCourse::firstOrCreate($studentCourse);
        }

        return response()->json(['msg' => 'success']);
    }

    public function storeStudent(Request $request)
    {
        $password = $request->get('password');
        /*$confirmPassword = $request->get('confirm_password');
        if($password != $confirmPassword){
            return response()->json(['msg' => 'password not match']);
        }*/

        $student = [
            'student_id' => $request->get('student_id'),
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'password' => bcrypt($password),
        ];
        $student = Student::firstOrCreate($student);
        if($student->image == ''){
            $student->image = self::getAvatarImage();
            $student->save();
        }
        return $student;
    }

    public function getProfile($id)
    {
        $student = Student::findOrFail($id);
        foreach ($student->courses as $course){

            $student_course = StudentCourse::where([
                ['student_id', '=', $student->id],
                ['course_id', '=', $course->id]
            ])->first();

            foreach ($course->lessons as $lesson){
                $student_lesson = StudentLesson::where([
                    ['student_course_id', '=', $student_course->id],
                    ['lesson_id', '=', $lesson->id]
                ])->first();

                if($student_lesson == null){
                    $lesson['progress'] = 0;
                }else{
                    $lesson['progress'] = $student_lesson->progress;
                }
            }
        }
        return $student;
    }

    public function updateProfile(Request $request)
    {
        $student = Student::findOrFail($request->get('id'));

        $name = $request->get('name');
        $email = $request->get('email');
        $username = $request->get('username');

        $student->name = $name;
        $student->email = $email;
        $student->username = $username;
        $student->save();

        return response()->json(['msg' => 'edit complete']);
    }

    public function getAll($course_id)
    {
        $data = [];

        $students = Student::all();
        $data['students'] = $students;

        $course = Course::findOrFail($course_id);
        $data['students_course'] = $course->students;

        return $data;
    }

    public function changePassword(Request $request)
    {
        $student_id = $request->get('student_id');
        $old_password = $request->get('old_password');
        $new_password = $request->get('new_password');

        $student = Student::findOrFail($student_id);
        $current_password_hash = $student->password;

        if(password_verify($old_password, $current_password_hash)){
            $student->password = password_hash($new_password, PASSWORD_DEFAULT);
            $student->save();

            return response()->json(['msg' => 'change password complete']);

        }else{
            return response()->json(['msg' => 'password is incorrect']);
        }
    }

    public function removeIP($id)
    {
        $student = Student::findOrFail($id);
        $student->ip = '';
        $student->save;
        return response()->json(['msg' => 'remove ip complete']);
    }
}
