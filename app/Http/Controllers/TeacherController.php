<?php

namespace App\Http\Controllers;

use App\TeacherCourse;
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

    public function destroy($id)
    {
        // Todo fix this bug see in log
        Log::info('Delete Teacher');
        $teacher =Teacher::find($id);
        $teacher->delete();
        return 'delete complete';
    }

    public function storeOneTeacherMember()
    {
        $course_id = Request::get('course_id');
        $teacher_id = Request::get('teacher_id');

        $teacherCourse = [
            'teacher_id' => $teacher_id,
            'course_id' => $course_id,
            'status' => 'active',
        ];
        TeacherCourse::create($teacherCourse);

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
}
