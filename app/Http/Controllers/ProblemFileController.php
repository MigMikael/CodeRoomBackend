<?php

namespace App\Http\Controllers;

use App\ProblemFile;
use App\ProblemInput;
use App\ProblemOutput;
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
        $version = 1;

        self::keepFile($problem_id, $problem_name, $file, $version);
    }

    public function edit()
    {
        $problem_id = Request::get('problem_id');
        $problem_name = Request::get('problem_name');
        $file = Request::get('file');

        $currentVersion = 0;
        $problemFiles = ProblemFile::where('problem_id', '=', $problem_id)->get();
        foreach ($problemFiles as $problemFile){
            if(sizeof($problemFile->inputs) > 0){   // This problemfile has input
                $input = $problemFile->inputs()->first();
                $currentVersion = $input->version;
            }
        }
        $version = ++$currentVersion;
        ProblemFile::where('problem_id', '=', $problem_id)->delete();

        self::keepFile($problem_id, $problem_name, $file, $version);
    }

    public function keepFile($problem_id, $problem_name, $file, $version)
    {
        $extension = $file->getClientOriginalExtension();
        Storage::disk('public')->put($problem_id.'_'.$problem_name.'.'.$extension, File::get($file));

        $dirName = 'problem/'.$problem_id.'_'.$problem_name;

        Storage::disk('public')->deleteDirectory($dirName);
        Storage::disk('public')->makeDirectory($dirName);

        $folderPath = storage_path('\\app\\public\\' . $dirName .'\\');
        $filePath = storage_path('app\\public\\'.$problem_id.'_'.$problem_name.'.'.$extension);

        $zipper = new Zipper();
        $zipper->make($filePath)->extractTo($folderPath);

        $sourcePath = $dirName.'/'.$problem_name.'/src/';
        $files = Storage::disk('public')->allFiles($sourcePath);

        foreach ($files as $file){
            //Log::info('##### '.$file);                               // com/amela/Book.java
            if(substr($file, -4) == 'java'){                           // read only java file
                $packageAndName = str_replace($sourcePath, '', $file); // dataStructures/LinkedList.java
                $temps = explode('/', $packageAndName);

                $packageName = '';
                $fileName = '';

                if(sizeof($temps) == 1){
                    $packageName = 'default package';
                    $fileName = $temps[0];
                }
                else if(sizeof($temps) > 1){
                    for($i = 0; $i < sizeof($temps)-1; $i++){
                        $packageName .= $temps[$i];
                        if($i != sizeof($temps)-2){
                            $packageName .= '.';
                        }
                    }
                    $fileName = $temps[sizeof($temps) -1];
                }

                $problemFile = [
                    'problem_id' => $problem_id,
                    'package' => $packageName,
                    'filename' => $fileName,
                    'mime' => 'java',
                    'code' => Storage::disk('public')->get($file),
                ];

                $problemFile = ProblemFile::create($problemFile);

                $temp = explode('.', $problemFile->filename);
                $inputFolderName = $temp[0];

                $inputPath = $dirName.'/'.$problem_name.'/testCase/'.$inputFolderName.'/';
                $inputFiles = Storage::disk('public')->allFiles($inputPath);
                foreach ($inputFiles as $inputFile){
                    $temps = explode('/', $inputFile);
                    $fileName = $temps[sizeof($temps) - 1];

                    if(strpos($fileName, 'in') != false) {          // This is input file
                        $problemInput = [
                            'problemfile_id' => $problemFile->id,
                            'version' => $version,
                            'filename' => $fileName,
                            'content' => Storage::disk('public')->get($inputFile)
                        ];
                        ProblemInput::create($problemInput);
                    }
                    else if(strpos($fileName, 'sol') != false) {    //This is output file
                        $problemOutput = [
                            'problemfile_id' => $problemFile->id,
                            'version' => $version,
                            'filename' => $fileName,
                            'content' => Storage::disk('public')->get($inputFile)
                        ];
                        ProblemOutput::create($problemOutput);
                    }
                }
            }
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
