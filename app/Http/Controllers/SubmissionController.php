<?php

namespace App\Http\Controllers;

use App\Submission;
use Illuminate\Support\Facades\DB;
use Request;
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

        $input_time = Request::get('time');
        $input_code = Request::get('code');

        $submission_data = [];
        $submission_data['user_id'] = $input_userId;
        $submission_data['prob_id'] = $input_probId;
        $submission_data['sub_num'] = $sub_num;
        $submission_data['time'] = $input_time;
        $submission_data['code'] = $input_code;

        Submission::create($submission_data);
        return redirect('submissions');
    }

    public function analyzeSubmission()
    {
        //Todo write this method
    }

}
