<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $input = $request->all();
        Announcement::create($input);
        return redirect('announcement');
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->course;

        //return view('announcement.show')->with('announcement', $announcement);
        //return $announcement;
        return Request::path();
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcement.edit')->with('announcement', $announcement);
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $newAnnouncement = $request->all();
        $announcement->update($newAnnouncement);

        return redirect('announcement');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        return 'Delete Finish';
    }

    #--------------------------------------------------------------------------------------------------------

    public function showAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        return $announcement;
    }

    public function storeAnnouncement(Request $request)
    {
        $input = $request->all();
        Announcement::create($input);

        return response()->json(['msg' => 'success']);
    }

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return response()->json(['msg' => 'success']);
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $updatedAnnouncement = $request->all();
        $announcement->update($updatedAnnouncement);

        return response()->json(['msg' => 'success']);
    }
}
