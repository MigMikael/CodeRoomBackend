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
        $input_id = Request::get('prob_id');
        $input_filename = Request::get('filename');
        $input_package = Request::get('package');
        $input_code = Request::get('code');

        Log::info('#### INPUT Data #### '.$input_filename.' ####');

        $json = self::sendProblem($input_id, $input_filename, $input_package, $input_code);

        Log::info('#### RESPONSE Data #### '.$json['class'][0]['name'].' ####');

        $classes = $json['class'];
        $prob_id = $json['prob_id'];
        $data = [];
        $count_class = 0;

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
            $count_class++;
            ProblemAnalysis::create($data);
            Log::info('#### COUNT CLASS #### '. $count_class .' ####');
        }
        Log::info('#### STATUS #### '. 'Finish' .' ####');
        
        //return redirect('problem_analysis');
        return "success na kub";
    }

    public function sendProblem($input_id ,$input_filename, $input_package, $input_code)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:3000/api/teacher/required', ['json' => ['prob_id' => $input_id, 'filename' => $input_filename, 'package' => $input_package, 'code' => $input_code]]);

        //$res = $client->request('POST', 'http://localhost:3000/api/teacher/required', ['json' => ['prob_id' => '32']]);
        $result = $res->getBody();
        $json = json_decode($result, true);
        return $json;
    }
}
