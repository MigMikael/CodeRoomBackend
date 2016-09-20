<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use App\Lesson;
use App\Problem;
use App\ProblemAnalysis;
use App\ProblemStructureScore;
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
        $input = Request::all();
        Lesson::create($input);
        return redirect('lesson');
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
                $score = ProblemStructureScore::where('id', '=', $structure->id)->first();

                $realStructure['class'] = $structure->class;
                $realStructure['class_score'] = $score->class;
                $realStructure['package'] = $structure->package;
                $realStructure['package_score'] = $score->package;
                $realStructure['enclose'] = $structure->enclose;
                $realStructure['enclose_score'] = $score->enclose;
                $realStructure['attribute'] = $structure->attribute;
                $realStructure['attribute_score'] = $score->attribute;
                $realStructure['method'] = $structure->method;
                $realStructure['method_score'] = $score->method;
                array_push($item['problemAnalysis'], $realStructure);
            }
            array_push($problem_list['problem'], $item);
        }

        return $problem_list;
    }
}
