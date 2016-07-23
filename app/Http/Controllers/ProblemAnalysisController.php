<?php

namespace App\Http\Controllers;

use App\ProblemAnalysis;
use Request;
use Log;
use App\Http\Requests;

class ProblemAnalysisController extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }
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

    public function latestAnalysis()
    {
        $problem_analysis = ProblemAnalysis::all()->last();

        $json = [];

        $json['prob_id'] = $problem_analysis->prob_id;
        $json['class'] = $problem_analysis->class;
        $json['package'] = $problem_analysis->package;
        $json['code'] = $problem_analysis->code;

        return $json;
    }

    public function getByID($prob_id)
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
        return \GuzzleHttp\json_encode($json);
    }

    public function keepScore()
    {
        $p = Request::all();

        for ($i = 0; $i < sizeof($p); $i++) {
            $prob_id = $p[$i]['prob_id'];
            Log::info('##### '. $prob_id);
            $class = '';
            for ($j = 0; $j < sizeof($p[$i]['class']); $j++) {
                $class .= $p[$i]['class'][$j];
                if($j != sizeof($p[$i]['class']) - 1 ) {
                    $class .= ';';
                }
            }
            Log::info('##### '. $class);
            $attribute_score = '';
            for ($j = 0; $j < sizeof($p[$i]['attribute']); $j++) {
                $attribute_score .= ($j + 1);
                $attribute_score .= ';';
                $attribute_score .= $p[$i]['attribute'][$j][3];
                if($j != sizeof($p[$i]['attribute']) - 1) {
                    $attribute_score .= '|';
                }
            }
            Log::info('##### '. $attribute_score);
            $method_score = '';
            for ($j = 0; $j < sizeof($p[$i]['method']); $j++) {
                $method_score .= ($j + 1);
                $method_score .= ';';
                $method_score .= $p[$i]['method'][$j][4];
                if($j != sizeof($p[$i]['method']) -1) {
                    $method_score .= '|';
                }
            }
            Log::info('##### '. $method_score);

            ProblemAnalysis::where('prob_id', '=', $prob_id)
                ->where('class', '=', $class)
                ->update(['attribute_score' => $attribute_score, 'method_score' => $method_score]);
        }

        return 'success';
    }
}
