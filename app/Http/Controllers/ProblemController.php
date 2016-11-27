<?php

namespace App\Http\Controllers;

use App\Problem;
use App\ProblemAnalysis;
use Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use Log;


class ProblemController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $problems = Problem::all();
        foreach ($problems as $problem){
            $problem->lesson;
        }
        return view('problem.index')->with('problems', $problems);
        //return $problems;
    }

    public function create()
    {
        return view('problem.create');
    }

    public function store()
    {
        $problem = [
            'lesson_id' => Request::get('lesson_id'),
            'name' => Request::get('name'),
            'description' => Request::get('description'),
            'evaluator' => Request::get('evaluator'),
            'timelimit' => Request::get('timelimit'),
            'memorylimit' => Request::get('memorylimit'),
            'is_parse' => Request::get('is_parse'),
        ];

        if(Request::hasFile('file')){
            $problem = Problem::create($problem);
            $file = Request::file('file');
            self::sendToProblemFile($problem, $file, 'create');
        } else {
            return 'file not found';
        }

        if($problem->is_parse == 'true'){
            //self::analyzeProblem($problem);
        }

        //return \GuzzleHttp\json_encode($problemAnalysis_json);
    }

    public function show($id)
    {
        $problem = Problem::withCount([
            'submissions' , 'problemFiles'
        ])->findOrFail($id);

        $problem->lesson;
        foreach ($problem->problemFiles as $problemFile){
            foreach ($problemFile->problemAnalysis as $analysis){
                $analysis->attributes;
                $analysis->constructors;
                $analysis->methods;
            }
        }
        foreach ($problem->submissions as $submission){
            $submission->student;
            $submission->code;
        }
        //return $problem;
        //return view('problem.show')->with('problem', $problem);
        return view('problem.show2')->with('problem', $problem);
    }

    public function edit($id)
    {
        $problem = Problem::findOrFail($id);
        return view('problem.edit')->with('problem', $problem);
    }

    public function update($id)
    {
        $problem = Problem::findOrFail($id);
        $newProblem = [
            'name' => Request::get('name'),
            'description' => Request::get('description'),
            'evaluator' => Request::get('evaluator'),
            'timelimit' => Request::get('timelimit'),
            'memorylimit' => Request::get('memorylimit'),
            'lesson_id' => Request::get('lesson_id'),
            'is_parse' => Request::get('is_parse'),
        ];
        $problem->update($newProblem);

        if(Request::hasFile('file')){
            $file = Request::file('file');
            self::sendToProblemFile($problem, $file, 'edit');
        }

        return 'update finish';
    }

    public function destroy($id)
    {
        $problem = Problem::findOrFail($id);

        $problem->delete();
        return "delete finish";
    }

    public function sendToProblemFile($problem, $file, $mode)
    {
        $problemFile = [
            'problem_id' => $problem->id,
            'problem_name' => $problem->name,
            'file' => $file
        ];
        if($mode == 'create'){
            $url = 'problemfile/add';
        }else{
            $url = 'problemfile/edit';
        }

        $request = Request::create($url, 'POST', $problemFile);
        $res = app()->handle($request);
        return $res;
    }

    public function analyzeProblem($problem)
    {
        $client = new Client();
        //Todo Send Problem To Evaluator
        $res = $client->request('POST', 'http://localhost:3000/api/teacher/required', ['json' => [
                'prob_id' => $problem->id,
                'filename' => '',
                'code' => ''
            ]
        ]);
        $result = $res->getBody();
        $json = json_decode($result, true);

        Log::info('#### '. $res->getBody());
        return $json;
    }

    public function keepProblemAnalysis($analyzeResult_json)
    {

    }

    public function getProblemAnalysis($prob_id)
    {
        $problem_analysis = ProblemAnalysis::where('problem_id', '=', $prob_id)->get();
        return $problem_analysis;
    }
}
