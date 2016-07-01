<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Scalar\MagicConst\File;

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
}
