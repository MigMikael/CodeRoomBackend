<?php

namespace App\Http\Middleware;

use App\Student;
use App\Teacher;
use Closure;
use Log;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userID = null;
        if($request->hasHeader('Authorization_Token')){
            $student = Student::where('token', '=', $request->header('Authorization_Token'))->first();

            if($student == null){
                $teacher = Teacher::where('token', '=', $request->header('Authorization_Token'))->first();

                if($teacher == null){
                    return response()->json(['status' => 'unauthorized']);
                }
            }

            //handle session expire
            if(!($request->session()->has('userID'))){
                return response()->json(['status' => 'session expired']);
            }

        }else{
            return response()->json(['status' => 'unauthorized']);
        }
        return $next($request);
    }
}
