<?php

namespace App\Http\Controllers;

use App\ProblemFile;
use Request;
use Log;
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
        Log::info('#### add file');
        $file = Request::file('filefield');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('public')->put($file->getFilename().'.'.$extension, File::get($file));
        $problemFile = new ProblemFile();
        $problemFile->mime = $file->getClientMimeType();
        $problemFile->original_filename = $file->getClientOriginalName();
        $problemFile->filename = $file->getFilename().'.'.$extension;

        $problemFile->save();

        return redirect('problemfile');
    }

    public function get($filename)
    {
        $filename = str_replace('_','.',$filename);
        Log::info('#### Change Filename '.$filename);

        $problemFile = ProblemFile::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('public')->get($problemFile->filename);
        
        return (new Response($file, 200))->header('Content-Type', $problemFile->mime);
    }
}
