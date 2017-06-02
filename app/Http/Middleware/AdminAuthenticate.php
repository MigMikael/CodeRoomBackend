<?php

namespace App\Http\Middleware;
use App\Teacher;
use Closure;

class AdminAuthenticate
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
        if ($request->hasHeader('Authorization_Token')){
            $token = $request->header('Authorization_Token');
            $teacher = Teacher::where('token', '=', $token)->first();

            if($teacher == null || $teacher->role != 'admin'){
                return response()->json(['status' => 'user unauthorized']);
            }
        }
        return $next($request);
    }
}
