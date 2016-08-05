<?php

namespace App\Http\Controllers;

use App\ProblemFile;
use Chumper\Zipper\Zipper;
use Request;
use Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

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

        $dirname = $problemFile->id.'-'.$problemFile->original_filename;

        Storage::disk('public')->makeDirectory($dirname);
        $dest = storage_path() . '/app/public/' . $dirname .'/';
        Log::info('#### dest '.$dest);

        $path = storage_path('app/public/'.$problemFile->filename);
        Log::info('#### path '.$path);

        $zipper = new Zipper();
        $zipper->make($path)->extractTo($dest);
        Log::info('#### extract complete');

        $input_filename = Request::get('filename');
        $input_package = Request::get('package');

        self::testGetFile($dirname, $input_filename);
        //self::keepProblem($input_filename, $input_package);

        return redirect('problemfile');
    }

    public function get($filename)
    {
        $filename = str_replace('_','.',$filename);

        $problemFile = ProblemFile::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('public')->get($problemFile->filename);
        
        return (new Response($file, 200))->header('Content-Type', $problemFile->mime);
    }

    public function keepProblem($input_filename, $input_package)
    {
        $filename = $input_filename . '.java';
        Storage::disk('public')->get($filename);
        $client = new Client();
        $client->request('POST' ,'localhost:8888/problems',['json' => [
            'filename' => $input_filename,
            'package' => $input_package,
            'code' =>'']
        ]);
    }

    public function testGetFile($dirname, $input_filename)
    {
        $filename = $input_filename . '.java';
        $pathToFile = storage_path() . '/app/public/' . $dirname .'/';
        Log::info('#### Path to File'. $pathToFile);
        $files = Storage::disk('public')->files($pathToFile);


        Log::info('#### File');
    }
}
