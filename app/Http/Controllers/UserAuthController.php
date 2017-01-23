<?php

namespace App\Http\Controllers;

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
                return $student;

            }else{
                return response()->json(['msg' => 'password is incorrect']);
            }

        }elseif($teacher != null){
            if(password_verify($password, $teacher->password)){
                $request->session()->put('userID', $teacher->id);
                $request->session()->put('userRole', 'teacher');
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
        //remove all data from this session
        $request->session()->flush();
        return response()->json(['msg' => 'logout complete']);
    }
}
