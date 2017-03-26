<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Method;
use App\Problem;
use App\ProblemAnalysis;
use App\ProblemFile;
use App\ProblemScore;
use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use Log;
use App\Submission;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        $lesson_id = $request->get('lesson_id');
        $order = Problem::where('lesson_id', '=', $lesson_id)->count();
        $order++;

        $problem = [
            'lesson_id' => $lesson_id,
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'evaluator' => $request->get('evaluator'),
            'order' => $order,
            'timelimit' => $request->get('timelimit'),
            'memorylimit' => $request->get('memorylimit'),
            'is_parse' => $request->get('is_parse'),
        ];

        if($request->hasFile('file')){
            $problem = Problem::create($problem);
            $file = $request->file('file');
            return self::sendToProblemFile($problem, $file, 'create');
        } else {
            return 'file not found';
        }
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
        }
        //echo $problem->problemFiles[0]->code;
        //return $problem;
        //return view('problem.show')->with('problem', $problem);
        return view('problem.show2')->with('problem', $problem);
    }

    public function edit($id)
    {
        $problem = Problem::findOrFail($id);
        return view('problem.edit')->with('problem', $problem);
    }

    public function update(Request $request, $id)
    {
        $problem = Problem::findOrFail($id);
        $newProblem = [
            'name'          => $request->get('name'),
            'description'   => $request->get('description'),
            'evaluator'     => $request->get('evaluator'),
            'timelimit'     => $request->get('timelimit'),
            'memorylimit'   => $request->get('memorylimit'),
            'lesson_id'     => $request->get('lesson_id'),
            'is_parse'      => $request->get('is_parse'),
        ];
        $problem->update($newProblem);

        if($request->hasFile('file')){
            $file = $request->file('file');
            self::sendToProblemFile($problem, $file, 'edit');
        }

        return 'update finish';
    }

    public function destroy($id)
    {
        $problem = Problem::findOrFail($id);

        $problem->delete();
        return 'Delete Finish';
    }

    public function getProblemAnalysis($prob_id)
    {
        $problem_analysis = ProblemAnalysis::where('problem_id', '=', $prob_id)->get();
        return $problem_analysis;
    }

    #--------------------------------------------------------------------------------------------------------

    public function getQuestion($problem_id)
    {
        $problem = Problem::findOrFail($problem_id);

        $dirName = 'problem/'.$problem->id.'_'.$problem->name.
            '/'.$problem->name.
            '/question/'.$problem->name.'.pdf';

        $file = Storage::disk('public')->get($dirName);

        return response($file, 200)->header('Content-Type', 'application/pdf');
    }

    public function showProblem($id)
    {
        $problem = Problem::findOrFail($id);
        $problemFiles = $problem->problemFiles;
        foreach ($problemFiles as $problemFile){
            $problemAnalysis = $problemFile->problemAnalysis;
            foreach ($problemAnalysis as $analysis){
                $analysis->attributes;
                $analysis->constructors;
                $analysis->methods;
            }
        }
        $problem['question'] = url('problem/getQuestion/'.$problem->id);
        $submission = Submission::where('problem_id', '=', $problem->id)->get()->last();
        $problem['lastSubmission'] = $submission;

        return $problem;
    }

    public function storeProblem(Request $request)
    {
        $lesson_id = $request->get('lesson_id');
        $order = Problem::where('lesson_id', '=', $lesson_id)->count();
        $order++;

        $problem = [
            'lesson_id' => $lesson_id,
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'evaluator' => $request->get('evaluator'),
            'order' => $order,
            'timelimit' => $request->get('timelimit'),
            'memorylimit' => $request->get('memorylimit'),
            'is_parse' => $request->get('is_parse'),
        ];

        if($request->hasFile('file')){
            $problem = Problem::create($problem);
            $file = $request->file('file');
            $msg = self::sendToProblemFile($problem, $file, 'create');

            if(strpos($msg, 'finish') !== false){
                foreach ($problem->problemFiles as $problemFile){
                    $problemFile['code'] = '';
                    foreach ($problemFile->problemAnalysis as $analysis){
                        $analysis->score;
                        $analysis->attributes;
                        $analysis->constructors;
                        $analysis->methods;
                    }
                }
                return $problem;

            }else{
                return response()->json(['msg' => 'error while parse code']);
            }

        } else {
            return response()->json(['msg' => 'file not found']);
        }
    }

    public function updateProblem(Request $request)
    {
        /*$id = $request->get('id');
        $problem = Problem::findOfFail($id);

        $problem->name = $request->get('name');
        $problem->description = $request->get('description');
        $problem->evaluator = $request->get('evaluator');
        $problem->timelimit = $request->get('timelimit');
        $problem->memorylimit = $request->get('memorylimit');
        $problem->lesson_id = $request->get('lesson_id');
        $problem->is_parse = $request->get('is_parse');

        if($request->hasFile('file')){
            $file = $request->file('file');
            self::sendToProblemFile($problem, $file, 'edit');
        }

        return response()->json(['msg' => 'success']);*/
    }

    public function storeProblemScore(Request $request)
    {
        $pFiles = $request->get('problem_files');
        foreach ($pFiles as $pFile){
            $pAs = $pFile['problem_analysis'];
            foreach ($pAs as $pA){
                $score = $pA['score'];
                $problem_score = ProblemScore::findOrFail($score['id']);
                $problem_score->class = $score['class'];
                $problem_score->package = $score['package'];
                $problem_score->enclose = $score['enclose'];
                $problem_score->extends = $score['extends'];
                $problem_score->implements = $score['implements'];
                $problem_score->save();

                $atts = $pA['attributes'];
                foreach ($atts as $att){
                    $attribute = Attribute::findOrFail($att['id']);
                    $attribute->score = $att['score'];
                    $attribute->save();
                }

                $cons = $pA['constructors'];
                foreach ($cons as $con){
                    $constructor = Attribute::findOrFail($con['id']);
                    $constructor->score = $con['score'];
                    $constructor->save();
                }

                $mets = $pA['methods'];
                foreach ($mets as $met){
                    $method = Method::findOrFail($met['id']);
                    $method->recursive = $met['recursive'];
                    $method->loop = $met['loop'];
                    $method->score = $met['score'];
                    $method->save();
                }
            }
        }
    }

    public function deleteProblem($id)
    {
        $problem = Problem::findOrFail($id);
        $problem->delete();

        return response()->json(['msg' => 'success']);
    }

    public function sendToProblemFile($problem, $file, $mode)
    {
        $currentIP = env('CURRENT_IP');

        $problemFile = [
            'problem_id' => $problem->id,
            'problem_name' => $problem->name,
            'file' => $file,
            'currentIP' => $currentIP
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

    public function changeProblemOrder(Request $request)
    {
        $newProblems = $request->all();
        $count = 0;
        foreach ($newProblems as $newProblem){
            $count++;
            $problem = Problem::findOrFail($newProblem['id']);
            $problem->order = $count;
            $problem->save();
        }

        return response()->json(['msg' => 'success']);
    }

    public function getProblemSubmission($id)
    {
        $submissions = Submission::where('problem_id', '=', $id)->get();
        foreach ($submissions as $submission){
            $submission->student;
            $submission->problem;
        }

        return $submissions;
    }
    
}
