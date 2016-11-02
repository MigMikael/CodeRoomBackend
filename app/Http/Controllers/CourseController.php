<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel;
use App\Announcement;
use App\Course;
use App\Lesson;
use App\StudentCourse;
use App\StudentLesson;
use App\Teacher;
use App\TeacherCourse;
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
        $file = Request::file('photo');

        Storage::disk('public')->put($file->getClientOriginalName(), File::get($file));

        $image_path = 'http://localhost:8000/api/course/image/'. str_replace('.','_',$file->getClientOriginalName());
        Log::info('#### '.$image_path);

        $course_data = [];
        $course_data['name'] = $input_name;
        $course_data['image'] = $image_path;
        Course::create($course_data);
        return redirect('course');
    }

    public function show($id)
    {
        $course = Course::find($id);
        $course->students;
        return view('course.show')->with('course', $course);
        //return $course;
    }

    public function addStudentMember()
    {
        return view('course.member');
    }

    public function storeStudentMember()
    {
        $course_id = Request::get('course_id');
        $studentListFile = Request::get('studentList');
        $fileName = $studentListFile->getClientOriginalName();
        Storage::disk('public')->put($fileName, File::get($studentListFile));

        /*$file = Storage::disk('public')->get($fileName);
        $data = Excel::load*/

        Log::info('#### Store File Complete');
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

    public function getDetailStudent($course_id, $student_id)
    {
        $course = Course::where('id', '=', $course_id)->first();

        /*$courseInstructor = [];
        $instructorsID = TeacherCourse::where('course_id', '=', $course_id)->pluck('teacher_id');
        foreach ($instructorsID as $instructorID){
            $teacher = Teacher::find($instructorID);
            array_push($courseInstructor, $teacher->name);
        }
        $course['instructor'] = $courseInstructor;*/

        $lessons = Lesson::where('course_id', '=', $course_id)->orderBy('order')->get();
        $lessonNum = Lesson::where([
            ['course_id', '=', $course_id],
            ['status', '=', 'true']
        ])->orderBy('order')->count();
        $quizNum = Lesson::where([
            ['course_id', '=', $course_id],
            ['status', '=', 'false']
        ])->orderBy('order')->count();
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
        $course['quiz_num'] = $quizNum;
        $course['lessons'] = $lessons;
        $course['announcement'] = $announcements;

        return $course;
    }

    public function getDetailTeacher($course_id, $teacher_id)
    {
        $course = Course::where('id', '=', $course_id)->first();
        $courseInstructor = [];
        $instructorsID = TeacherCourse::where('course_id', '=', $course_id)->pluck('teacher_id');

        foreach ($instructorsID as $instructorID){
            $teacher = Teacher::find($instructorID);
            //Log::info('instructor id: '. $teacher->name);
            array_push($courseInstructor, $teacher->name);
        }
        $course['instructor'] = $courseInstructor;

        $lessons = Lesson::where('course_id', '=', $course_id)->orderBy('order')->get();
        $lessonNum = Lesson::where([
            ['course_id', '=', $course_id],
            ['status', '=', 'true']
        ])->orderBy('order')->count();
        $quizNum = Lesson::where([
            ['course_id', '=', $course_id],
            ['status', '=', 'false']
        ])->orderBy('order')->count();
        $announcements = Announcement::where('course_id', '=', $course_id)->get();

        $course['lesson_num'] = $lessonNum;
        $course['quiz_num'] = $quizNum;
        $course['lessons'] = $lessons;
        $course['announcement'] = $announcements;

        return $course;
    }

    public function getBadge($course_id)
    {
        $course = Course::find($course_id);
        Log::info('#### '.$course->name);
        $badges = $course->badges;

        return $badges;
    }

    public function getStudentMember($course_id)
    {
        $course = Course::find($course_id);
        $studentMember = $course->students;

        return $studentMember;
    }

    public function getTeacherMember($course_id)
    {
        $course = Course::find($course_id);
        $teachers = $course->teachers;

        return $teachers;
    }
}
