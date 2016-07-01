<?php

namespace App\Http\Controllers;

use App\ProblemFile;
use Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ProblemFileController extends Controller
{
    public function index()
    {
        $problemFiles = ProblemFile::all();
        
        return view('problemfiles.index')->with('problemFiles', $problemFiles);
    }

    public function add()
    {
        $file = Request::file('filefield');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension, File::get($file));
        $problemFile = new ProblemFile();
        $problemFile->mime = $file->getClientMimeType();
        $problemFile->original_filename = $file->getClientOriginalName();
        $problemFile->filename = $file->getFilename();

        $problemFile->save();

        return redirect('problemfile');
    }

    public function get($filename)
    {
        $problemFile = ProblemFile::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($problemFile->filename);
        
        return (new Response($file, 200))->header('Content-Type', $problemFile->mime);
    }
}
