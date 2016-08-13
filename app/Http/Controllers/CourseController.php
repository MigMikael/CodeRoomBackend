<?php

namespace App\Http\Controllers;

use App\Course;
use Request;

use App\Http\Requests;

class CourseController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $courses = Course::all();
        return view('course.index')->with('courses', $courses);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store()
    {
        $input = Request::all();
        Course::create($input);
        return redirect('course');
    }
}
