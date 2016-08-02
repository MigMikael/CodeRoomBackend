<?php

namespace App\Http\Controllers;

use App\Problem;
use App\ProblemAnalysis;
use Request;

use App\Http\Requests;

use GuzzleHttp\Client;
use Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProblemController extends Controller
{
    public function index()
    {
        $problems = Problem::all();

        return view('problems.index')->with('problems', $problems);
    }

    public function create()
    {
        return view('problems.create');
    }

    public function store()
    {
        $input_filename = Request::get('filename');
        $input_package = Request::get('package');
        $input_code = Request::get('code');
        Log::info('#### INPUT Data #### '.$input_filename.' ####');

        $problem_data = [];
        $problem_data['name'] = $input_filename;
        $problem_data['code'] = $input_code;
        Problem::create($problem_data);
        Log::info('#### STATUS #### '. 'Keep Problem' .' ####');

        $problem = Problem::all()->last();
        $input_id = $problem->id;

        $analyzeResult_json = self::analyzeProblem($input_id, $input_filename, $input_package, $input_code);
        self::keepProblemAnalysis($analyzeResult_json);
        $problemAnalysis_json = self::getProblemAnalysis($input_id);

        return \GuzzleHttp\json_encode($problemAnalysis_json);
    }

    public function analyzeProblem($input_id, $input_filename, $input_package, $input_code)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:3000/api/teacher/required', ['json' => [
            'prob_id' => $input_id,
            'filename' => $input_filename,
            'package' => $input_package,
            'code' => $input_code]
        ]);
        $result = $res->getBody();
        $json = json_decode($result, true);

        Log::info('#### STATUS #### '. 'Analyze Problem' .' ####');
        return $json;
    }

    public function keepProblemAnalysis($analyzeResult_json)
    {
        $classes = $analyzeResult_json['class'];
        $prob_id = $analyzeResult_json['prob_id'];
        $data = [];

        foreach ($classes as $class) {
            $data['prob_id'] = $prob_id;
            $data['class'] = $class['modifier'].';'.$class['name'];
            $data['enclose'] = $class['enclose'];

            $attributes = $class['attribute'];
            $count = 1;
            foreach ($attributes as $attribute) {
                $data['attribute'] = $count.';'
                    .$attribute['modifier'].';'
                    .$attribute['datatype'].';'
                    .$attribute['name'].'|';

                $count++;
            }

            $methods = $class['method'];
            $count = 1;
            foreach ($methods as $method) {
                $data['method'] = $count.';'
                    .$method['modifier'].';'
                    .$method['return_type'].';'
                    .$method['name'].';'
                    .'(';
                //$params = $method['params'];
                //foreach ($params as $param) {
                //    $data['method'] .= $param['datatype_params'].';'
                //        .$param['name_params'].'|';
                //}
                $data['method'] .= ')';
                $count++;
            }
            ProblemAnalysis::create($data);
        }
        Log::info('#### STATUS #### '. 'Keep Problem Analysis' .' ####');
    }

    public function getProblemAnalysis($prob_id)
    {
        $problem_analysis = ProblemAnalysis::where('prob_id', '=', $prob_id)->get();
        $json = [];

        for ($i = 0 ; $i < sizeof($problem_analysis); $i++) {
            $json[$i]['prob_id'] = $problem_analysis[$i]->prob_id;
            $json[$i]['class'] = $problem_analysis[$i]->class;
            $json[$i]['package'] = $problem_analysis[$i]->package;
            $json[$i]['attribute'] = $problem_analysis[$i]->attribute;
            $json[$i]['method'] = $problem_analysis[$i]->method;
        }
        Log::info('#### STATUS #### '. 'Get Problem Analysis' .' ####');
        return $json;
    }
}
