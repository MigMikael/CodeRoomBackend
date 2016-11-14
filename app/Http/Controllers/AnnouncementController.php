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
        $announcements = Announcement::orderBy('course_id')->get();
        foreach ($announcements as $announcement){
            $announcement->course;
        }
        return view('announcement.index')->with('announcements', $announcements);
        //return $announcements;
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

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->course;
        return view('announcement.show')->with('announcement', $announcement);
        //return $announcement;
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcement.edit')->with('announcement', $announcement);
    }

    public function update($id)
    {
        $announcement = Announcement::findOrFail($id);
        $newAnnouncement = Request::all();
        $announcement->update($newAnnouncement);

        return redirect('announcement');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        return back();
    }
}
