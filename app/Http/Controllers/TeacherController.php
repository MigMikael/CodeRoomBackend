<?php

namespace App\Http\Controllers;

use App\Teacher;
use Request;

use App\Http\Requests;

class TeacherController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index')->with('teachers', $teachers);
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store()
    {
        $input = Request::all();
        Teacher::create($input);
        return redirect('teacher');
    }
}
