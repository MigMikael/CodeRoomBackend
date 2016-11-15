<?php

namespace App\Http\Controllers;

use App\ProblemAnalysis;
use App\ProblemStructureScore;
use App\Result;
use App\ResultStructureScore;
use App\Submission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Request;
use GuzzleHttp\Client;
use App\Http\Requests;
use Log;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::all()->sortByDesc('created_at');
        foreach ($submissions as $submission){
            $submission->student;
            $submission->code = '';
        }
        return view('submission.index')->with('submissions', $submissions);
        //return $submissions;
    }

    public function create()
    {
        return view('submission.create');
    }

    public function store()    
    {
        $student_id = Request::get('student_id');
        $problem_id = Request::get('problem_id');

        $sub_num = DB::table('submission')->where([
            ['student_id', '=', $student_id],
            ['problem_id', '=', $problem_id],
        ])->count();
        $sub_num++;

        $code = Request::get('code');

        $submission = [
            'student_id' => $student_id,
            'problem_id' => $problem_id,
            'sub_num' => $sub_num,
            'code' => $code
        ];

        $submission = Submission::create($submission);
        return redirect('submission');

        /*$submission_id = Submission::all()->last()->id;

        $analyze_result = self::analyzeSubmission($submission_id, $input_code);
        self::keepResult($submission_id, $analyze_result);
        $score = self::calculateScore($input_probId, $submission_id);

        return $score;*/
    }

    public function show($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->student;
        $submission->problem->code = '';
        return view('submission.show')->with('submission', $submission);
        //return $submission;
    }

    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();
        return back();
    }

    public function analyzeSubmission($submission_id, $input_code)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:3000/api/student/code', ['json' => [
                'prob_id' => $submission_id,
                'filename' => 'Test',
                'package' => 'default package',
                'code' => $input_code
            ]
        ]);
        $result = $res->getBody();
        $json = json_decode($result, true);

        Log::info('#### STATUS #### 2 Analyze Submission ####');
        Log::info('#### Data From Evaluator : '. $res->getBody());

        return $json;
    }

    public function keepResult($submission_id, $analyze_result)
    {
        $classes = $analyze_result['class'];
        $data = [];
        foreach ($classes as $class) {
            $data['submission_id'] = $submission_id;
            $data['class'] = $class['modifier'].';'.$class['static_required'].';'.$class['name'];
            $data['package'] = 'default package'; // Todo change this default package
            $data['enclose'] = $class['enclose'];

            $constructors = $class['constructure'];
            $count = 1;
            $data['constructor'] = '';
            foreach ($constructors as $constructor) {
                $data['constructor'] .= $count.';'
                    .$constructor['modifier'].';'
                    .$constructor['name'].';'
                    .'(';
                $params = $constructor['params'];
                foreach ($params as $param){
                    $data['constructor'] .= $param['datatype'].' '
                        .$param['name'].', ';
                }
                $data['constructor'] .= ')|';
                $count++;
            }

            $count = 1;
            $data['attribute'] = '';
            $attributes = $class['attribute'];
            foreach ($attributes as $attribute) {
                $data['attribute'] .= $count.';'
                    .$attribute['modifier'].';'
                    .$attribute['static_required'].';'
                    .$attribute['datatype'].';'
                    .$attribute['name'].'|';
                $count++;
            }

            $count = 1;
            $data['method'] = '';
            $methods = $class['method'];
            foreach ($methods as $method) {
                $data['method'] .= $count.';'
                    .$method['modifier'].';'
                    .$method['static_required'].';'
                    .$method['return_type'].';'
                    .$method['name'].';'
                    .'(';
                $params = $method['params'];
                foreach ($params as $param) {
                    $data['method'] .= $param['datatype'].' '
                        .$param['name'].', ';
                }
                $data['method'] .= ')|';
                $count++;
            }
            Result::create($data);
        }
        Log::info('#### STATUS #### 3 Keep Result ####');
    }

    public function calculateScore($input_probId, $submission_id)
    {
        $problem_analysis = ProblemAnalysis::where('prob_id', '=', $input_probId)->get();
        $results = Result::where('submission_id', '=', $submission_id)->get();

        $real_score = [];

        for($i = 0; $i < sizeof($problem_analysis); $i++) {
            $score = [];

            $problem_analysis_class = $problem_analysis[$i]['class'];
            $results_class = $results[$i]['class'];
            $problem_structure_score = ProblemStructureScore::where('id', '=', $problem_analysis[$i]->id)->value('class');
            if($problem_analysis_class == $results_class){
                $score['class'] = $problem_structure_score;
            } else {
                $score['class'] = "0";
            }

            $problem_analysis_package = $problem_analysis[$i]['package'];
            $results_package = $results[$i]['package'];
            $problem_structure_score = ProblemStructureScore::where('id', '=', $problem_analysis[$i]->id)->value('package');
            if($problem_analysis_package == $results_package){
                $score['package'] = $problem_structure_score;
            } else {
                $score['package'] = "0";
            }

            $problem_analysis_enclose = $problem_analysis[$i]['enclose'];
            $results_enclose = $results[$i]['enclose'];
            $problem_structure_score = ProblemStructureScore::where('id', '=', $problem_analysis[$i]->id)->value('enclose');
            if($problem_analysis_enclose == $results_enclose){
                $score['enclose'] = $problem_structure_score;
            } else {
                $score['enclose'] = "0";
            }
            /*  Todo continue this
                1. Test Submit Student Code
                2. Check if Evaluator is correct
                3. Check if this method is correct
                4. Try send score to web submission
            */

            $problem_analysis_attribute = explode("|", $problem_analysis[$i]['attribute']);
            $results_attribute = explode("|", $results[$i]['attribute']);
            $problem_structure_score = ProblemStructureScore::where('id', '=', $problem_analysis[$i]->id)->value('attribute');
            $total_scores = explode("|", $problem_structure_score);

            //maybe it contain empty string remove it!!!
            if(($key = array_search("", $problem_analysis_attribute)) !== false) {
                unset($problem_analysis_attribute[$key]);
            }
            if(($key = array_search("", $results_attribute)) !== false) {
                unset($results_attribute[$key]);
            }
            $current_score = '';
            for ($j = 0; $j < sizeof($problem_analysis_attribute); $j++) {
                Log::info('#### Teacher Attribute '.$problem_analysis_attribute[$j]);
                Log::info('#### Student Attribute '.$results_attribute[$j]);
                Log::info('#### Score Attribute '.$total_scores[$j]);
                if($problem_analysis_attribute[$j] == $results_attribute[$j]) {
                    $s = explode(";", $total_scores[$j])[1];
                    $current_score .= $problem_analysis_attribute[$j].';'.$s.'|';
                }else{
                    // Todo Handle this
                    $current_score .= $problem_analysis_attribute[$j].';0|';
                }
            }
            Log::info('#### Current Score Attribute : '.$current_score);
            $score['attribute'] = $current_score;


            $problem_analysis_constructor = explode("|", $problem_analysis[$i]['constructor']);
            $results_constructor = explode("|", $results[$i]['constructor']);
            $problem_structure_score = ProblemStructureScore::where('id', '=', $problem_analysis[$i]->id)->value('constructor');
            $total_scores = explode("|", $problem_structure_score);
            //maybe it contain empty string remove it!!!
            if(($key = array_search("", $problem_analysis_constructor)) !== false) {
                unset($problem_analysis_constructor[$key]);
            }
            if(($key = array_search("", $results_constructor)) !== false) {
                unset($results_constructor[$key]);
            }
            $current_score = '';
            for ($j = 0; $j < sizeof($problem_analysis_constructor); $j++) {
                Log::info('#### Teacher Constructor '.$problem_analysis_constructor[$j]);
                Log::info('#### Student Constructor '.$results_constructor[$j]);
                Log::info('#### Score Constructor '.$total_scores[$j]);
                if($problem_analysis_constructor[$j] == $results_constructor[$j]) {
                    $s = explode(";", $total_scores[$j])[1];
                    $current_score .= $problem_analysis_constructor[$j].';'.$s.'|';
                }else{
                    $current_score .= $problem_analysis_constructor[$j].';0|';
                }
            }
            Log::info('#### Current Score Constructor : '.$current_score);
            $score['constructor'] = $current_score;


            $problem_analysis_method = explode("|", $problem_analysis[$i]['method']);
            $results_method = explode("|", $results[$i]['method']);
            $problem_structure_score = ProblemStructureScore::where('id', '=', $problem_analysis[$i]->id)->value('method');
            $total_scores = explode("|", $problem_structure_score);
            //maybe it contain empty string remove it!!!
            if(($key = array_search("", $problem_analysis_method)) !== false) {
                unset($problem_analysis_method[$key]);
            }
            if(($key = array_search("", $results_method)) !== false) {
                unset($results_method[$key]);
            }
            $current_score = '';
            for ($j = 0; $j < sizeof($problem_analysis_method); $j++) {
                Log::info('#### Teacher Method '.$problem_analysis_method[$j]);
                Log::info('#### Student Method '.$results_method[$j]);
                Log::info('#### Score Method '.$total_scores[$j]);
                if($problem_analysis_method[$j] == $results_method[$j]) {
                    $s = explode(";", $total_scores[$j])[1];
                    $current_score .= $problem_analysis_method[$j].';'.$s.'|';
                }else{
                    $current_score .= $problem_analysis_method[$j].';0|';
                }
            }
            Log::info('#### Current Score Method : '.$current_score);
            $score['method'] = $current_score;

            ResultStructureScore::create($score);
            array_push($real_score, $score);
        }

        $score = [];
        $score['problem_analysis'] = $problem_analysis;
        $score['results'] = $results;

        return $real_score;
    }

}
