<?php

namespace App\Http\Controllers;

use App\ProblemAnalysis;
use App\ProblemStructureScore;
use Request;
use Log;
use App\Http\Requests;

class ProblemAnalysisController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $problemsAnalysis = ProblemAnalysis::orderBy('problem_id')->get();
        foreach ($problemsAnalysis as $analysis){
            $analysis->problem->code = '';
        }
        return view('problems_analysis.index')->with('problems_analysis', $problemsAnalysis);
        //return $problemsAnalysis;
    }

    public function create()
    {
        //return view('problems_analysis.create');
    }

    public function store()
    {
        $input = Request::all();
        ProblemAnalysis::create($input);
        return redirect('problems_analysis');
    }

    public function show($id)
    {
        /*
        $problemAnalysis = ProblemAnalysis::findOrFail($id);
        return view('problems_analysis.show')->with('problem_analysis', $problemAnalysis);
        */
    }

    public function edit($id)
    {
        $problemAnalysis = ProblemAnalysis::findOrFail($id);
        return view('problems_analysis')->with('problemAnalysis', $problemAnalysis);
    }

    public function update($id)
    {
        $problemAnalysis = ProblemAnalysis::findOrFail($id);
        $newProblemAnalysis = [
            'problem_id' => Request::get('problem_id'),
            'class' => Request::get('class'),
            'package' => Request::get('package'),
            'enclose' => Request::get('enclose'),
            'attribute' => Request::get('attribute'),
            'constructor' => Request::get('constructor'),
            'method' => Request::get('method'),
        ];
        $problemAnalysis->update($newProblemAnalysis);

        return redirect('problem_analysis');
    }

    public function destroy($id)
    {
        $problemAnalysis = ProblemAnalysis::findOrFail($id);
        $problemAnalysis->delete();
        return back();
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
        return $problem_analysis;
    }

    public function keepScore()
    {
        $p = Request::all();

        for ($i = 0; $i < sizeof($p); $i++) {
            $prob_id = $p[$i]['prob_id'];
            Log::info('##### '. $prob_id);
            $class = $p[$i]['class'][6];
            $package = $p[$i]['package'][6];
            $enclose = $p[$i]['enclose'][6];
            Log::info('##### '. $class);

            $attribute_score = '';
            for ($j = 0; $j < sizeof($p[$i]['attribute']); $j++) {
                $attribute_score .= ($j + 1);
                $attribute_score .= ';';
                $attribute_score .= $p[$i]['attribute'][$j][6];
                if($j != sizeof($p[$i]['attribute']) - 1) {
                    $attribute_score .= '|';
                }
            }
            Log::info('##### '. $attribute_score);

            $constructor_score = '';
            for ($j = 0; $j < sizeof($p[$i]['constructor']); $j++) {
                $constructor_score .= ($j + 1);
                $constructor_score .= ';';
                $constructor_score .= $p[$i]['constructor'][$j][6];
                if($j != sizeof($p[$i]['constructor']) - 1) {
                    $constructor_score .= '|';
                }
            }
            Log::info('##### '. $constructor_score);

            $method_score = '';
            for ($j = 0; $j < sizeof($p[$i]['method']); $j++) {
                $method_score .= ($j + 1);
                $method_score .= ';';
                $method_score .= $p[$i]['method'][$j][6];
                if($j != sizeof($p[$i]['method']) - 1) {
                    $method_score .= '|';
                }
            }
            Log::info('##### '. $method_score);

            $data = [];
            $data['class'] = $class;
            $data['package'] = $package;
            $data['enclose'] = $enclose;
            $data['attribute'] = $attribute_score;
            $data['constructor'] = $constructor_score;
            $data['method'] = $method_score;

            ProblemStructureScore::create($data);
            Log::info('##### Keep Problem Structure Score');
        }

        return 'success';
    }
}
