<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
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
        $lessons = Lesson::all();
        return view('lesson.index')->with('lessons', $lessons);
    }

    public function create()
    {
        return view('lesson.create');
    }

    public function store()
    {
        Log::info('#### this is LessonController');
        $input = Request::all();
        Lesson::create($input);
        $request = Request::create('badge', 'POST', $input);
        $res = app()->handle($request);

        // Todo it not redriect to lesson/index why?
        return redirect()->action('LessonController@index');
    }

    public function getProblem($lesson_id)
    {
        $problems = Problem::where('lesson_id', '=', $lesson_id)->get();

        $problem_list = [];
        $lesson_name = Lesson::where('id', '=', $lesson_id)->value('name');
        $problem_list['lesson_name'] = $lesson_name;
        $problem_list['problem'] = [];
        foreach ($problems as $problem){
            $item = [];
            $item['prob_id'] = $problem->id;
            $item['name'] = $problem->name;
            $item['timelimit'] = $problem->timelimit;
            $item['memorylimit'] = $problem->memorylimit;
            $item['lesson_id'] = $problem->lesson_id;

            $problemfilepath = 'http://localhost:8000/problemfile/getQuestion/'.$problem->id;
            $item['problemfile'] = $problemfilepath;

            $item['problemAnalysis'] = [];
            $structures = ProblemAnalysis::where('prob_id', '=', $problem->id)->get();
            $realStructure = [];
            foreach ($structures as $structure){
                $teacherScore = ProblemStructureScore::where('id', '=', $structure->id)->first();
                $studentScore = ResultStructureScore::where('id', '=', $structure->id)->first();

                $realStructure['class'] = $structure->class;
                $realStructure['class_score'] = $teacherScore->class;
                $realStructure['package'] = $structure->package;
                $realStructure['package_score'] = $teacherScore->package;
                $realStructure['enclose'] = $structure->enclose;
                $realStructure['enclose_score'] = $teacherScore->enclose;
                $realStructure['attribute'] = $structure->attribute;
                $realStructure['attribute_score'] = $teacherScore->attribute;
                $realStructure['constructor'] = $structure->constructor;
                $realStructure['constructor_score'] = $teacherScore->constructor;
                $realStructure['method'] = $structure->method;
                $realStructure['method_score'] = $teacherScore->method;
                if($studentScore == null){
                    $realStructure['student_attribute_score'] = '0';
                    $realStructure['student_method_score'] = '0';
                }else{
                    // 1;private;String;man;5|2;private;String;au;5|
                    $temps = explode('|',$studentScore->attribute);
                    $attScore = '';
                    foreach ($temps as $temp) {
                        if($temp != null){
                            $temp2 = explode(';', $temp);
                            $attScore .= $temp2[0].';'.$temp2[4].'|';
                        }
                    }
                    $realStructure['student_attribute_score'] = $attScore;

                    $temps = explode('|',$studentScore->method);
                    $methodScore = '';
                    foreach ($temps as $temp) {
                        if($temp != null){
                            $temp2 = explode(';', $temp);
                            $methodScore .= $temp2[0].';'.$temp2[5].'|';
                        }
                    }
                    $realStructure['student_method_score'] = $methodScore;
                }
                array_push($item['problemAnalysis'], $realStructure);
            }
            array_push($problem_list['problem'], $item);
        }

        return $problem_list;
    }
}
