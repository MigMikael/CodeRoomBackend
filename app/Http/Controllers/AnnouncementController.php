<?php

namespace App\Http\Controllers;

use App\Announcement;
use Request;

use App\Http\Requests;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $announcements = Announcement::all();
        return view('announcement.index')->with('announcements', $announcements);
    }

    public function create()
    {
        return view('announcement.create');
    }

    public function store()
    {
        $input = Request::all();
        Announcement::create($input);
        return redirect('announcement');
    }
}
