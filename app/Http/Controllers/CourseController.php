<?php

namespace App\Http\Controllers;

use App\Helper\TokenGenerate;
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
        $file = Request::file('photo');
        $token = (new TokenGenerate())->generate(6);

        Storage::disk('public')->put($file->getClientOriginalName(), File::get($file));
        $image_path = url('api/course/image/'). str_replace('.','_',$file->getClientOriginalName());
        //Log::info('#### '.$image_path);

        $course_data = [
            'name' => $name ,
            'color' => $color,
            'status' => 'enable',
            'image' => $image_path,
            'token' => $token
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
            $image_path = url('api/course/image/'). str_replace('.','_',$file->getClientOriginalName());
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

    #--------------------------------------------------------------------------------------------------------

    public function showCourseUser()
    {
        $courses = Course::enable()->get();
        return $courses;
    }

    public function showCourseStudent($student_id, $course_id)
    {
        $course = Course::withCount([
            'students', 'teachers', 'lessons', 'badges', 'announcements'
        ])->findOrFail($course_id);

        //$student = Student::findOrFail($student_id);

        $course['lessons'] = Lesson::where('course_id', '=', $course_id)->ordered()->get();

        foreach ($course['lessons'] as $lesson){
            $lesson['problems_count'] = $lesson->problems()->count();
        }
        foreach ($course->lessons as $lesson){
            $student_course = StudentCourse::where([
                ['student_id', '=', $student_id],
                ['course_id', '=', $course->id]
            ])->first();

            $student_lesson = StudentLesson::where([
                ['student_id', '=', $student_id],
                ['lesson_id', '=', $lesson->id]
            ])->first();

            if($student_lesson == null){
                $lesson['progress'] = 0;
            }else{
                $lesson['progress'] = $student_lesson->progress;
            }

            $lesson['problems_count'] = $lesson->problems()->count();
        }

        $course->badges;
        $course->announcements;

        return $course;
    }

    public function showCourseTeacher($course_id)
    {
        $course = Course::withCount([
            'students', 'teachers', 'lessons', 'badges', 'announcements'
        ])->findOrFail($course_id);

        $course['lessons'] = Lesson::where('course_id', '=', $course_id)->ordered()->get();
        foreach ($course['lessons'] as $lesson){
            $lesson['problems_count'] = $lesson->problems()->count();
        }
        $course->badges;
        $course->announcements;
        $course->students;

        return $course;
    }

    public function getMember($id)
    {
        $course = Course::findOrFail($id)->makeHidden('token');
        foreach ($course->students as $student){
            $student->makeHidden('token');
            $student->pivot;
            $student->lessons;
        }
        foreach ($course->teachers as $teacher){
            //$teacher->courses;
            $teacher->pivot;
        }

        return $course;
    }

    public function joinCourse()
    {
        $course_id = Request::get('course_id');
        $student_id = Request::get('student_id');
        $token = Request::get('token');

        $course = Course::findOrFail($course_id);

        $student_course = StudentCourse::where([
            ['student_id', '=', $student_id],
            ['course_id', '=', $course_id]
        ])->first();

        if(sizeof($student_course) > 0){
            return response()->json(['msg' => 'already join this course']);
        }

        if($course->token == $token){
            $student_course = [
                'student_id' => $student_id,
                'course_id' => $course_id,
                'status' => 'enable',
                'progress' => 0
            ];

            StudentCourse::create($student_course);
            return response()->json(['msg' => 'join course success']);
        }else{
            return response()->json(['msg' => 'token mismatch']);
        }
    }

    public function changeStatus($course_id)
    {
        $course = Course::findOrFail($course_id);
        if($course->status == 'enable'){
            $course->status = 'disable';
        }else{
            $course->status = 'enable';
        }
        $course->save();

        return back();
    }

    public function adminStore()
    {
        $name = Request::get('name');
        $color = Request::get('color');
        $file = Request::file('image');
        $token = (new TokenGenerate())->generate(6);

        Storage::disk('public')->put($file->getClientOriginalName(), File::get($file));
        $image_path = url('api/course/image/'). str_replace('.','_',$file->getClientOriginalName());

        $course_data = [
            'name' => $name ,
            'color' => $color,
            'status' => 'enable',
            'image' => $image_path,
            'token' => $token
        ];
        $course = Course::firstOrCreate($course_data);

        return \response()->json(['course_id' => $course->id]);
    }

    public function storeFile($file)
    {
        $ex = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename(). '.' . $ex, File::get($file));
        $fileRecord = [
            'name' => $file->getFilename(). '.' . $ex,
            'mime' => $file->getClientMimeType(),
            'original_name' => $file->getClientOriginalName(),
        ];
        $file = \App\Image::create($fileRecord);
        return $file;
    }

    public function getTeacherCourse($course_id)
    {
        $course = Course::findOrFail($course_id);
        $teachers = $course->teachers;
        foreach ($teachers as $teacher){
            $teacher->makeHidden(['token', 'role']);
        }
        return $teachers;
    }

    public function addTeacher($course_id)
    {
        $course = Course::findOrFail($course_id);
        $teachers = Request::get('teachers');
        foreach ($teachers as $teacher){
            $teacher_course = [
                'teacher_id' => $teacher['id'],
                'course_id' => $course->id,
                'status' => 'enable'
            ];
            TeacherCourse::firstOrCreate($teacher_course);
        }

        return \response()->json(['msg' => 'add Teacher Complete']);
    }
}
