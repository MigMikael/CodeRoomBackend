<?php

namespace App\Http\Controllers;

use App\BadgeStudent;
use Request;

use App\Http\Requests;

class BadgeStudentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {

    }

    public function create()
    {
        return view('badge_student.create');
    }

    public function store()
    {
        $badgeStudent = [
            'student_id' => Request::get('student_id'),
            'badge_id' => Request::get('badge_id')
        ];
        $badgeStudent = BadgeStudent::firstOrCreate($badgeStudent);

        return $badgeStudent;
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }
}
