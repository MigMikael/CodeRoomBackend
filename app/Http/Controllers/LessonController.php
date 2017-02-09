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
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        //Log::info('#### this is LessonController');
        $input = $request->all();
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

    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $newLesson = $request->all();
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

    #--------------------------------------------------------------------------------------------------------

    public function showLesson($id)
    {
        $lesson = Lesson::withCount([
            'problems'
        ])->findOrFail($id);

        foreach ($lesson->problems as $problem){
            $problem['question'] = url('problem/getQuestion/'.$problem->id);
        }

        return $lesson;
    }

    public function updateLesson(Request $request)
    {
        $updatedLessonId = $request->get('id');
        $updatedLessonName = $request->get('name');

        $lesson = Lesson::findOrFail($updatedLessonId);
        $lesson->name = $updatedLessonName;
        $lesson->save();

        return response()->json(['msg' => 'success']);
    }

    public function storeLesson(Request $request)
    {
        $input = [
            'name' => $request->get('name'),
            'course_id' => $request->get('course_id'),
            'status' => 'false',
            'order' => Lesson::count()+1
        ];

        $lesson = Lesson::create($input);

        // Todo fix it
        //$request = $request->create('api/gen_lesson_badge', 'POST', $lesson);
        //$res = app()->handle($request);

        return response()->json(['msg' => 'success']);
    }

    public function deleteLesson($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return response()->json(['msg' => 'success']);
    }

    public function changeLessonOrder(Request $request)
    {
        $newLessons = $request->all();
        $count = 0;
        foreach ($newLessons as $newLesson){
            $count++;
            $lesson = Lesson::findOrFail($newLesson['id']);
            $lesson->order = $count;
            $lesson->save();
        }

        return response()->json(['msg' => 'success']);
    }
}
