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
        $submissions = Submission::all();
        return view('submissions.index')->with('submissions', $submissions);
    }

    public function create()
    {
        return view('submissions.create');
    }

    public function store()    
    {
        $input_userId = Request::get('user_id');
        $input_probId = Request::get('prob_id');

        $sub_num = DB::table('submission')->where([
            ['user_id', '=', $input_userId],
            ['prob_id', '=', $input_probId],
        ])->count();
        $sub_num++;

        $input_code = Request::get('code');

        $submission_data = [];
        $submission_data['user_id'] = $input_userId;
        $submission_data['prob_id'] = $input_probId;
        $submission_data['sub_num'] = $sub_num;
        $submission_data['code'] = $input_code;
        Submission::create($submission_data);
        Log::info('#### STATUS #### 1 Keep Submission ####');

        $submission_id = Submission::all()->last()->id;

        $analyze_result = self::analyzeSubmission($submission_id, $input_code);
        self::keepResult($submission_id, $analyze_result);
        $score = self::calculateScore($input_probId, $submission_id);

        return $score;
    }

    public function analyzeSubmission($submission_id, $input_code)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:3000/api/student/code', ['json' => [
            'prob_id' => $submission_id,
            'filename' => 'Test',
            'package' => 'default package',
            'code' => $input_code]
        ]);
        $result = $res->getBody();
        $json = json_decode($result, true);

        Log::info('#### STATUS #### 2 Analyze Submission ####');
        return $json;
    }

    public function keepResult($submission_id, $analyze_result)
    {
        $classes = $analyze_result['class'];
        $data = [];
        foreach ($classes as $class) {
            $data['submission_id'] = $submission_id;
            $data['class'] = $class['modifier'].';'.$class['name'];
            $data['enclose'] = $class['enclose'];

            $count = 1;
            $data['attribute'] = '';
            $attributes = $class['attribute'];
            foreach ($attributes as $attribute) {
                $data['attribute'] .= $count.';'
                    .$attribute['modifier'].';'
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
                    .$method['return_type'].';'
                    .$method['name'].';'
                    .'(';

                $data['method'] .= ')';
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

        for($i = 0; $i < sizeof($problem_analysis); $i++) {
            $score = [];

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
                }
            }
            Log::info('#### Current Score '.$current_score);
            $score['attribute'] = $current_score;



            $problem_analysis_method = explode("()", $problem_analysis[$i]['method']);
            $results_method = explode("()", $results[$i]['method']);
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
                }
            }
            Log::info('#### Current Score '.$current_score);
            $score['method'] = $current_score;

            ResultStructureScore::create($score);
        }

        $score = [];
        $score['problem_analysis'] = $problem_analysis;
        $score['results'] = $results;

        return $score;
    }

}
