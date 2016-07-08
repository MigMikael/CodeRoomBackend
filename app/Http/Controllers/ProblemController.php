<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;

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
        self::sendProblem();
        return view('problems.create');
    }

    public function sendProblem()
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:3000/api/teacher/required', ['json' => ['prob_id' => '17']]);
        $result= $res->getBody();
        $json = json_decode($result);
        
        Log::info('#### POST Data #### '.$json->class[0]->name.' ####');
    }
}
