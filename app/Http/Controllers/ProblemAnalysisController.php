<?php

namespace App\Http\Controllers;

use App\ProblemAnalysis;
use Request;
use Log;
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

    public function edit($prob_id)
    {
        $problem_analysis = ProblemAnalysis::where('prob_id', '=', $prob_id)->get()->last();

        return view('problems_analysis.edit')->with('problem_analysis', $problem_analysis);
    }

    public function update($prob_id)
    {
        $problem_analysis = ProblemAnalysis::where('prob_id', '=', $prob_id)->get()->last();

        $input = Request::all();

        $json = json_decode($input, true);

        /*$problem_analysis->where('prob_id', $problem_analysis->prob_id)
            ->update(array(
                'class' => $json['class'],
                'package' => $json['package'],
                'enclose' => $json['enclose'],
                'attribute' => $json['attribute'],
                'method' => $json['method'],
                'code' => $json['code']
            ));*/

        return $input;
    }

    public function keep()
    {
        $input = Request::getContent();

        $json = json_decode($input, true);

        //$prob_id = $json['prob_id'];

        $classes = $json['class'];

        $data = [];

        foreach ((array)$classes as $class) {
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

    public function test()
    {
        $input = Request::getContent();
        $s = urldecode($input); // class={:modifier=>"public", :name=>"test", :attribute=>[{:datatype=>"int", :name=>"x"}]}
        $json = json_decode($s);

        /*$str = '{
                    "type": "donut",
                    "name": "Cake",
                    "toppings": [
                        { "id": "5002", "type": "Glazed" },
                        { "id": "5006", "type": "Chocolate with Sprinkles" },
                        { "id": "5004", "type": "Maple" }
                    ]
                }';
        $json = json_decode($str);*/

        Log::info('#### INPUT #### '.$input.' ####');
        Log::info('#### STRING #### '.$s.' ####');
        Log::info('#### JSON #### '.$json->type.' ####');
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
