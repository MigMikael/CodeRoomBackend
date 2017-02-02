<?php

namespace App\Http\Controllers;

use App\Helper\TokenGenerate;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Log;


class UserAuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        Log::info('password: '.$password);

        $student = Student::where('username', '=', $username)->first();
        $teacher = Teacher::where('username', '=', $username)->first();
        if($student != null){
            if(password_verify($password, $student->password)){
                $request->session()->put('userID', $student->id);
                $request->session()->put('userRole', 'student');
                $student['role'] = 'student';
                return $student;

            }else{
                return response()->json(['msg' => 'password is incorrect']);
            }

        }elseif($teacher != null){
            if(password_verify($password, $teacher->password)){
                $request->session()->put('userID', $teacher->id);
                $request->session()->put('userRole', $teacher->role);
                return $teacher;

            }else{
                return response()->json(['msg' => 'password is incorrect']);
            }

        }else{
            return response()->json(['msg' => 'username is incorrect']);
        }
    }

    public function logout(Request $request)
    {
        //remove all data from this session with flush
        $request->session()->flush();
        return response()->json(['msg' => 'logout complete']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        //Todo validate register data
        $studentID = $request->input('student_id');
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $generator = new TokenGenerate();
        $image = $this->getAvatarImage();

        $student = [
            'student_id' => $studentID,
            'name' => $name,
            'image' => $image,
            'token' => $generator->generate(32),
            'username' => $username,
            'password' => $password
        ];
        $student = Student::create($student);

        return $student;
    }

    public function getAvatarImage()
    {
        $request = Request::create('/image/gen_user_avatar_image', 'GET');
        $res = app()->handle($request);
        $image_id = $res->getContent();

        return $image_id;
    }

}
