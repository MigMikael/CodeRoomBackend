<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use App\Lesson;
use App\Student;
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
        $name = Request::get('name');
        $color = Request::get('color');
        $status = Request::get('status');
        $file = Request::file('photo');

        Storage::disk('public')->put($file->getClientOriginalName(), File::get($file));
        $image_path = 'http://localhost:8000/api/course/image/'. str_replace('.','_',$file->getClientOriginalName());
        Log::info('#### '.$image_path);

        $course_data = [
            'name' => $name , 'color' => $color, 'status' => $status, 'image' => $image_path
        ];
        Course::firstOrCreate($course_data);
        return redirect('course');
    }

    public function show($id)
    {
        $course = Course::withCount([
            'students', 'teachers', 'lessons', 'badges', 'announcements'
        ])->findOrFail($id);

        foreach ($course->students as $student){
            $student->pivot;
        }
        foreach ($course->teachers as $teacher){
            $teacher->pivot;
        }
        $course->lessons;
        $course->badges;
        $course->announcements;
        return view('course.show')->with('course', $course);
        //return $course;
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('course.edit')->with('course', $course);
    }

    public function update($id)
    {
        $course = Course::findOrFail($id);
        $image_path = $course->image;

        $name = Request::get('name');
        $color = Request::get('color');
        $status = Request::get('status');

        if(Request::hasFile('photo')){
            $file = Request::file('photo');
            Storage::disk('public')->put($file->getClientOriginalName(), File::get($file));
            $image_path = 'http://localhost:8000/api/course/image/'. str_replace('.','_',$file->getClientOriginalName());
            Log::info('#### '.$image_path);
        }
        $newCourse = [
            'name' => $name, 'color' => $color,
            'status' => $status, 'image' => $image_path
        ];
        $course->update($newCourse);

        return redirect('course');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return 'Delete Finish';
    }

    public function addStudentMember()
    {
        return view('course.member');
    }

    public function addTeacherMember()
    {
        return view('course.teacher_member');
    }

    public function getCourseImage($name)
    {
        $name = str_replace('_','.',$name);
        //Log::info('#### '.$name);
        $file = Storage::disk('public')->get($name);
        $mimeType = Storage::disk('public')->mimeType($name);

        return (new Response($file, 200))->header('Content-Type', $mimeType);
    }

    public function getAll()
    {
        $courses = Course::all();
        return $courses;
    }

    public function getDetailStudent($course_id, $student_id)
    {
        $student = Student::where('id', '=', $student_id)->first();
        $course = Course::where('id', '=', $course_id)->first();

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
            ['student_id', '=', $student->id],
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

    public function getDetailAdmin($course_id, $admin_id)
    {
        $course = Course::findOrFail($course_id);
        foreach ($course->teachers as $teacher){
            $teacher->pivot->status;
        }
        return $course;
    }

    public function getBadge($course_id)
    {
        $course = Course::findOrFail($course_id);
        Log::info('#### '.$course->name);
        $badges = $course->badges;

        return $badges;
    }

    public function getStudentMember($course_id)
    {
        $course = Course::findOrFail($course_id);
        $studentMember = $course->students()->where('status', 'active')->get();

        return $studentMember;
    }

    public function getTeacherMember($course_id)
    {
        $course = Course::findOrFail($course_id);
        $teachers = $course->teachers;

        return $teachers;
    }

    public function changeStatus($course_id)
    {
        $course = Course::findOrFail($course_id);
        if($course->status == 'active'){
            $course->status = 'inactive';
        }else{
            $course->status = 'active';
        }
        $course->save();

        return back();
    }
}
