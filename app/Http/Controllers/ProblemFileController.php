<?php

namespace App\Http\Controllers;

use App\ProblemFile;
use Chumper\Zipper\Zipper;
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

        /*$dirname = substr($problemFile->original_filename,0,4);
        Storage::disk('public')->makeDirectory($dirname);
        $dest = storage_path();
        $dest .= 'app/public/'.$dirname.'/';
        Log::info('#### dest '.$dest);*/

        $dirname = $problemFile->id.'-'.$problemFile->original_filename;

        Storage::disk('public')->makeDirectory($dirname);
        $dest = storage_path() . '/app/public/' . $dirname .'/';
        Log::info('#### dest '.$dest);

        $path = storage_path('app/public/'.$problemFile->filename);
        Log::info('#### path '.$path);

        $zipper = new \Chumper\Zipper\Zipper;
        $zipper->make($path)->extractTo($dest);
        Log::info('#### extract complete');

        return redirect('problemfile');
    }

    public function get($filename)
    {
        $filename = str_replace('_','.',$filename);

        $problemFile = ProblemFile::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('public')->get($problemFile->filename);
        
        return (new Response($file, 200))->header('Content-Type', $problemFile->mime);
    }
}
