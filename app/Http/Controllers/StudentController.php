<?php

namespace App\Http\Controllers;

use App\Student;
use Request;

use App\Http\Requests;

class StudentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $students = Student::all();

        return view('student.index')->with('students', $students);
    }

    public function create()
    {
        return view('student.create');
    }

    public function store()
    {
        $input = Request::all();
        Student::create($input);
        return redirect('student');
    }
}
