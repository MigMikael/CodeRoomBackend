<?php

namespace App\Http\Controllers;

use App\Teacher;
use Request;
use Log;
use App\Http\Requests;

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

    public function store()
    {
        $teacher = Request::all();
        $teacher['image'] = self::getAvatarImage();
        $teacher = Teacher::create($teacher);
        return $teacher;
    }

    public function getAvatarImage()
    {
        $request = Request::create('api/image/gen_user_avatar_image', 'GET');
        $res = app()->handle($request);
        $image_id = $res->getContent();

        return $image_id;
    }
}
