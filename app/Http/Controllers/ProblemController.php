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
        $input_lesson_id = Request::get('lesson_id');
        $input_code = Request::get('code');
        Log::info('#### INPUT Data #### '.$input_filename.' ####');

        $problem_data = [];
        $problem_data['name'] = $input_filename;
        $problem_data['lesson_id'] = $input_lesson_id;
        $problem_data['code'] = $input_code;
        Problem::create($problem_data);
        Log::info('#### STATUS #### '. 'Keep Problem' .' ####');

        $problem = Problem::all()->last();
        $input_id = $problem->id;

        $analyzeResult_json = self::analyzeProblem($input_id, $input_filename, $input_package, $input_code);
        self::keepProblemAnalysis($analyzeResult_json, $input_package);
        $problemAnalysis_json = self::getProblemAnalysis($input_id);
        Log::info('#### Before Send to UI'. $problemAnalysis_json);

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

        Log::info('#### '. $res->getBody());
        Log::info('#### STATUS #### '. 'Analyze Problem' .' ####');
        return $json;
    }

    public function keepProblemAnalysis($analyzeResult_json, $input_package)
    {
        Log::info('#### '. $input_package);
        $prob_id = $analyzeResult_json['prob_id'];
        $classes = $analyzeResult_json['class'];
        $data = [];

        foreach ($classes as $class) {
            $data['prob_id'] = $prob_id;
            $data['class'] = $class['modifier'].';'.$class['static_required'].';'.$class['name'];
            $data['package'] = $input_package;
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

            $attributes = $class['attribute'];
            $count = 1;
            $data['attribute'] = '';
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
            ProblemAnalysis::create($data);
        }
        Log::info('#### STATUS #### '. 'Keep Problem Analysis' .' ####');
    }

    public function getProblemAnalysis($prob_id)
    {
        $problem_analysis = ProblemAnalysis::where('prob_id', '=', $prob_id)->get();
        return $problem_analysis;
    }
}
