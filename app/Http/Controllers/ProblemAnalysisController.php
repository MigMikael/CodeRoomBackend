<?php

namespace App\Http\Controllers;

use App\ProblemAnalysis;
use Request;
use App\Http\Requests;

class ProblemAnalysisController extends Controller
{
    public function index()
    {
        $problems_analysis = ProblemAnalysis::all();
        
        return view('problems_analysis.index')->with('problems_analysis', $problems_analysis);
    }

    public function create()
    {
        return view('problems_analysis.create');
    }

    public function store()
    {
        $input = Request::all();

        ProblemAnalysis::create($input);

        return redirect('problems_analysis');
    }

    public function keep()
    {
        $input = Request::all();
        
        //var_dump($input);

        //$prob_id = $input['prob_id'];

        $classes = $input['class'];

        $data = [];

        foreach ($classes as $class) {
            //$data['prob_id'] = $prob_id;
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
                    .$method['returntype'].';'
                    .$method['name'].';'
                    .'(';

                $params = $method['params'];
                foreach ($params as $param) {
                    $data['method'] .= $param['datatype_params'].';'
                        .$param['name_params'].'|';
                }
                $data['method'] .= ')';

                $count++;
            }

            ProblemAnalysis::create($data);
        }
    }
    
    public function latestAnalysis()
    {
        $problem_analysis = ProblemAnalysis::all()->last();

        $json = [];

        $json['prob_id'] = $problem_analysis->prob_id;
        $json['class'] = $problem_analysis->class;
        $json['package'] = $problem_analysis->package;
        $json['code'] = $problem_analysis->code;

        //var_dump($json);
        return $json;
    }
}
