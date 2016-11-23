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

    }

    public function add()
    {
        $problem_id = Request::get('problem_id');
        $problem_name = Request::get('problem_name');
        $file = Request::get('file');

        $extension = $file->getClientOriginalExtension();
        Storage::disk('public')->put($problem_id.'_'.$problem_name.'.'.$extension, File::get($file));

        $dirName = 'problem/'.$problem_id.'_'.$problem_name; // problem_id for unique file name

        Storage::disk('public')->makeDirectory($dirName);
        $folderPath = storage_path('\\app\\public\\' . $dirName .'\\');
        $filePath = storage_path('app\\public\\'.$problem_id.'_'.$problem_name.'.'.$extension);

        /*Log::info('#### Extract Dest '. $folderPath);
        Log::info('#### Path File '. $filePath);*/

        $zipper = new Zipper();
        $zipper->make($filePath)->extractTo($folderPath);

        $sourcePath = $dirName.'/'.$problem_name.'/src/';

        $files = Storage::disk('public')->allFiles($sourcePath);
        foreach ($files as $file){
            Log::info('##### '.$file);
            /*if(substr($file, -4) == 'java'){ // read only java file
                $packageAndName = str_replace($sourcePath, '', $file); // dataStructures/LinkedList.java
                $temp = explode('/', $packageAndName);
                $packageName = $temp[0];
                $fileName = $temp[1];

                $problemFile = [
                    'problem_id' => $problem_id,
                    'package' => $packageName,
                    'filename' => $fileName,
                    'mime' => 'java',
                    'code' => Storage::disk('public')->get($file),
                ];
                ProblemFile::create($problemFile);
            }*/
        }

        return 'finish';
    }

    public function get($filename)
    {
        //Todo rewrite this method
        $filename = str_replace('_','.',$filename);

        $problemFile = ProblemFile::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('public')->get($problemFile->filename);
        
        return (new Response($file, 200))->header('Content-Type', $problemFile->mime);
    }

    public function getQuestion($problem_id)
    {
        $problem = Problem::findOrFail($problem_id);
        $questionPath = '/'.$problem->id.'_'.$problem->name.'/'.$problem->name.'/question/'.$problem->name.'.pdf';
        $question = Storage::disk('public')->get($questionPath);

        return (new Response($question, 200))->header('Content-Type', 'application/pdf');
    }
}
