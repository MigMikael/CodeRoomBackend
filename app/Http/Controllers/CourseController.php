<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use App\Lesson;
use App\StudentCourse;
use App\StudentLesson;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Request;
use Log;
use DB;

class CourseController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $courses = Course::all();
        return view('course.index')->with('courses', $courses);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store()
    {
        $input_name = Request::get('name');
        $input_instructor = Request::get('instructor');
        $file = Request::file('photo');

        Storage::disk('public')->put($file->getClientOriginalName(), File::get($file));

        $image_path = 'http://localhost:8000/api/course/image/'. str_replace('.','_',$file->getClientOriginalName());
        Log::info('#### '.$image_path);

        $course_data = [];
        $course_data['name'] = $input_name;
        $course_data['instructor'] = $input_instructor;
        $course_data['image'] = $image_path;
        Course::create($course_data);
        return redirect('course');
    }

    public function getCourseImage($name)
    {
        $name = str_replace('_','.',$name);
        Log::info('#### '.$name);
        $file = Storage::disk('public')->get($name);
        //Todo change content type
        return (new Response($file, 200))->header('Content-Type', 'image/png');
    }

    public function getAll()
    {
        $courses = Course::all();
        return $courses;
    }

    public function getDetail($course_id, $student_id)
    {
        $course = Course::where('id', '=', $course_id)->first();
        $lessons = Lesson::where('course_id', '=', $course_id)->orderBy('order')->get();
        $lessonNum = Lesson::where('course_id', '=', $course_id)->orderBy('order')->count();
        $announcements = Announcement::where('course_id', '=', $course_id)->get();

        $student_course = StudentCourse::where([
            ['student_id', '=', $student_id],
            ['course_id', '=', $course_id]
        ])->first();
        $student_course_id = $student_course->id;

        $lessons_progress = StudentLesson::where('student_course_id', '=', $student_course_id)->get();
        $size = sizeof($lessons_progress);

        for ($i = 0; $i < sizeof($lessons); $i++){
            if($size > 0) {
                $lessons[$i]['progress'] = $lessons_progress[$i]['progress'];
            }else{
                $lessons[$i]['progress'] = 0;
            }
            $size--;
        }

        $course['lesson_num'] = $lessonNum;
        $course['lessons'] = $lessons;
        $course['announcement'] = $announcements;

        return $course;
    }
}
