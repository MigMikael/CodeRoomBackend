<?php

namespace App\Http\Controllers;

use App\TeacherCourse;
use App\Teacher;
use Illuminate\Http\Request;
use Log;

class TeacherController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index')->with('teachers', $teachers);
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $password = $request->get('password');
        /*$confirmPassword = $request->get('confirm_password');
        if($password != $confirmPassword){
            return 'password not match';
        }*/

        $teacher = [
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($password),
            'status' => 'enable',
            'role' => 'teacher'
        ];
        $teacher = Teacher::firstOrCreate($teacher);
        if($teacher->image == ''){
            $teacher->image = self::getAvatarImage();
            $teacher->save();
        }
        return $teacher;
    }

    public function show($id)
    {
        $teacher = Teacher::withCount([
            'courses'
        ])->findOrFail($id);

        foreach ($teacher->courses as $course){
            $course->pivot;
        }

        return view('teacher.show')->with('teacher', $teacher);
        //return $teacher;
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teacher.edit')->with('teacher', $teacher);
    }

    public function update($id)
    {
        $teacher = Teacher::findOrFail($id);

        $newTeacher = [
            'name' => Request::get('name'),
            'username' => Request::get('username'),
        ];
        $teacher->update($newTeacher);

        return redirect('teacher');
    }

    public function destroy($id)
    {
        $teacher =Teacher::findOrFail($id);
        $teacher->delete();
        return 'Delete Finish';
    }

    public function storeOneTeacherMember(Request $request)
    {
        $course_id = $request->get('course_id');
        $teacher_id = $request->get('teacher_id');

        $teacherCourse = [
            'teacher_id' => $teacher_id,
            'course_id' => $course_id,
            'status' => 'active',
        ];
        TeacherCourse::firstOrCreate($teacherCourse);

        return 'add teacher complete';
    }

    public function getAvatarImage()
    {
        $request = Request::create('api/image/gen_user_avatar_image', 'GET');
        $res = app()->handle($request);
        $image_id = $res->getContent();

        return $image_id;
    }

    public function getAll()
    {
        $teachers = Teacher::all();
        return $teachers;
    }

    public function changeStatus($teacher_id, $course_id)
    {
        $teacherCourse = TeacherCourse::where([
            ['teacher_id', '=', $teacher_id],
            ['course_id', '=', $course_id]
        ])->first();

        if($teacherCourse->status == 'enable'){
            $teacherCourse->status = 'disable';
        }else{
            $teacherCourse->status = 'enable';
        }
        $teacherCourse->save();

        return back();
    }

    #--------------------------------------------------------------------------------------------------------

    public function dashboard(Request $request)
    {
        $userID = $request->session()->get('userID');
        //$userRole = $request->session()->get('userRole');

        $teacher = Teacher::findOrFail($userID);
        $teacher['courses'] = $teacher->courses()->withCount([
            'students', 'teachers', 'lessons',
        ])->get();

        $data = [];
        $data['teacher'] = $teacher;

        /*$courses = Course::withCount([
            'students', 'teachers', 'lessons'
        ])->get();
        $data['courses'] = $courses;*/

        return $data;
    }

    public function getProfile($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->courses;
        return $teacher;
    }

    public function updateProfile(Request $request)
    {
        $teacher = Teacher::findOrFail($request->get('id'));

        $name = $request->get('name');
        $email = $request->get('email');
        $username = $request->get('username');

        $teacher->name = $name;
        $teacher->email = $email;
        $teacher->username = $username;
        $teacher->save();

        return response()->json(['msg' => 'edit complete']);
    }

    public function changePassword(Request $request)
    {
        $teacher_id = $request->get('teacher_id');
        $old_password = $request->get('old_password');
        $new_password = $request->get('new_password');

        $teacher = Teacher::findOrFail($teacher_id);
        $current_password_hash = $teacher->password;

        if(password_verify($old_password, $current_password_hash)){
            $teacher->password = password_hash($new_password, PASSWORD_DEFAULT);
            $teacher->save();

            return response()->json(['msg' => 'change password complete']);

        }else{
            return response()->json(['msg' => 'password is incorrect']);
        }
    }

    public function changeState($teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        if($teacher->status == 'enable'){
            $teacher->status = 'disable';
        }else{
            $teacher->status = 'enable';
        }
        $teacher->save();

        return back();
    }
}
