<?php

namespace App\Http\Controllers;

use App\Problem;
use App\ProblemAnalysis;
use Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Scalar\MagicConst\File;

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
        //self::sendProblem();
        return view('problems.create');
    }

    public function store()
    {
        $input = Request::all();

        $json = self::sendProblem($input);

        //Problem::create($input);

        //return redirect('problems');

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

                /*$params = $method['params'];
                foreach ($params as $param) {
                    $data['method'] .= $param['datatype_params'].';'
                        .$param['name_params'].'|';
                }*/
                $data['method'] .= ')';

                $count++;
            }
            $count_class++;
            ProblemAnalysis::create($data);
            Log::info('#### COUNT CLASS #### '. $count_class .' ####');
        }
        Log::info('#### STATUS #### '. 'Finish' .' ####');
        
        return redirect('problem_analysis');
    }

    public function sendProblem($input)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:3000/api/teacher/required', ['json' => ['prob_id' => '26']]);
        $result = $res->getBody();
        $json = json_decode($result, true);

        return $json;
    }
}
