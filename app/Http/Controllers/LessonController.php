<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use App\Badge;
use App\Lesson;
use App\Problem;
use App\ProblemAnalysis;
use App\ProblemStructureScore;
use App\ResultStructureScore;
use Request;
use Log;
use App\Http\Requests;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::orderBy('course_id')
            ->orderBy('order')
            ->get();
        foreach ($lessons as $lesson){
            $lesson->course;
        }
        return view('lesson.index')->with('lessons', $lessons);
        //return $lessons;
    }

    public function create()
    {
        return view('lesson.create');
    }

    public function store()
    {
        Log::info('#### this is LessonController');
        $input = Request::all();
        $lesson = Lesson::create($input);

        $request = Request::create('api/gen_lesson_badge', 'POST', $input);
        $res = app()->handle($request);

        return $lesson;
        /* Todo it still lost port when redirect
        if($res->getContent() == 'gen finish'){
            return redirect('lesson');
        }else{
            return 'fail';
        }*/
    }

    public function show($id)
    {
        $lesson = Lesson::withCount(['problems'])->findOrFail($id);
        $lesson->course;
        $lesson->problems;
        foreach ($lesson->problems as $problem){
            $problem->code = '';
        }
        return view('lesson.show')->with('lesson', $lesson);
        //return $lesson;
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('lesson.edit')->with('lesson', $lesson);
    }

    public function update($id)
    {
        $lesson = Lesson::findOrFail($id);
        $newLesson = Request::all();
        $lesson->update($newLesson);

        return redirect('lesson');
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $badge = Badge::where('name', $lesson->name)->firstOrFail();
        $badge->delete();
        $lesson->delete();
        return 'Delete Finish';
    }

    // Todo wtf what I have done T_T
    public function getProblem($lesson_id)
    {
        $lesson = Lesson::findOrFail($lesson_id);
        foreach ($lesson->problems as $problem){
            $dirName = 'problem/'.$problem->id.'_'.$problem->name;
            $questionPath = $dirName.'/'.$problem->name.'/question/'.$problem->name.'.pdf';
            $problem->question = $questionPath;
        }
        return $lesson;
    }

    public function changeLessonOrder()
    {
        $data = Request::all();
        $newLessons = $data['lessons'];
        $count = 0;
        foreach ($newLessons as $newLesson){
            $count++;
            $lesson = Lesson::findOrFail($newLesson['id']);
            $lesson->order = $count;
            $lesson->save();
            Log::info($lesson->name);
        }

    }
}
