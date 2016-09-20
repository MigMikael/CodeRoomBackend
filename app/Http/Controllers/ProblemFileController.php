<?php

namespace App\Http\Controllers;

use App\ProblemFile;
use Chumper\Zipper\Zipper;
use Request;
use Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Problem;

class ProblemFileController extends Controller
{
    public function index()
    {
        $problemFiles = ProblemFile::all();
        return view('problemfiles.index')->with('problemFiles', $problemFiles);
    }

    public function create()
    {
        return view('problemfiles.create');
    }

    public function add()
    {
        Log::info('#### 1 add file');
        $input_filename = Request::get('filename');
        $input_package = Request::get('package');
        $input_lesson_id = Request::get('lesson_id');
        $file = Request::file('filefield');

        $extension = $file->getClientOriginalExtension();
        Storage::disk('public')->put($file->getFilename().'.'.$extension, File::get($file));
        $problemFile = new ProblemFile();
        $problemFile->mime = $file->getClientMimeType();
        $problemFile->original_filename = $file->getClientOriginalName();
        $problemFile->filename = $file->getFilename().'.'.$extension;
        $problemFile->save();

        $dirname = $problemFile->id;

        Storage::disk('public')->makeDirectory($dirname);
        $dest = storage_path() . '\\app\\public\\' . $dirname .'\\';
        Log::info('#### 2 dest '.$dest);

        $path = storage_path('app\\public\\'.$problemFile->filename);
        Log::info('#### 3 path '.$path);

        $zipper = new Zipper();
        $zipper->make($path)->extractTo($dest);
        Log::info('#### 4 extract complete');

        $id = ProblemFile::all()->last()->id;
        $code = Storage::disk('public')->get('\\' . $dirname . '\\' . $input_filename . '.java');
        $res = self::keepProblem($id, $input_filename, $input_package, $input_lesson_id, $code);

        return $res;
    }

    public function get($filename)
    {
        $filename = str_replace('_','.',$filename);

        $problemFile = ProblemFile::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('public')->get($problemFile->filename);
        
        return (new Response($file, 200))->header('Content-Type', $problemFile->mime);
    }

    public function keepProblem($id, $input_filename, $input_package, $input_lesson_id, $code)
    {
        $args = array(
            'id' => $id,
            'filename' => $input_filename,
            'package' => $input_package,
            'lesson_id' => $input_lesson_id,
            'code' => $code
        );
        $request = Request::create('problems', 'POST', $args);
        $res = app()->handle($request);
        Log::info('#### 5 Send Problem Complete');
        return $res;
    }

    public function getQuestion($prob_id)
    {
        $problem = Problem::where('id', '=', $prob_id)->firstOrFail();
        $filename = $problem->name;
        $pdf_name = $filename;
        $pdf_name = $pdf_name . '.pdf';
        Log::info('#### Get File');
        $file = Storage::disk('public')->get('/'. $prob_id . '/' . $pdf_name);

        return (new Response($file, 200))->header('Content-Type', 'application/pdf');
    }
}
