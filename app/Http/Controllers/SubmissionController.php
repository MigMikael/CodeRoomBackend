<?php

namespace App\Http\Controllers;

use App\Submission;
use Request;
use App\Http\Requests;

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
        $input = Request::all();

        Submission::create($input);

        return redirect('submissions');
    }
}
