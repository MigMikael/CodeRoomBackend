<?php

namespace App\Http\Controllers;

use App\SubmissionFile;
use Request;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use Log;

class SubmissionFileController extends Controller
{
    public function store()
    {
        $submission_id = Request::get('submission_id');
        $problem_name = Request::get('problem_name');
        $file = Request::get('file');

        $extension = $file->getClientOriginalExtension();
        Storage::disk('public')->put('submission_'.$submission_id.'.'.$extension, File::get($file));

        $dirName = 'submission/'.$submission_id.'_'.$problem_name;

        Storage::disk('public')->makeDirectory($dirName);
        $folderPath = storage_path('\\app\\public\\' . $dirName .'\\');
        $filePath = storage_path('app\\public\\submission_'.$submission_id.'.'.$extension);

        $zipper = new Zipper();
        $zipper->make($filePath)->extractTo($folderPath);

        $sourcePath = $dirName.'/'.$problem_name.'/src/';
        $files = Storage::disk('public')->allFiles($sourcePath);

        $hasDriver = false;

        foreach ($files as $file){
            if(substr($file, -4) == 'java'){ // read only java file
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

                if($packageName == 'driver'){
                    $hasDriver = true;
                }

                $submissionFile = [
                    'submission_id' => $submission_id,
                    'package' => $packageName,
                    'filename' => $fileName,
                    'mime' => 'java',
                    'code' => Storage::disk('public')->get($file),
                ];
                SubmissionFile::create($submissionFile);
            }
        }

        //Todo Delete zip file when finish (permission deny)
        //Storage::disk('public')->delete('submission_'.$submission_id.'.'.$extension);
        //unlink($filePath);


        if($hasDriver == false){
            return 'finish no driver appear';
        } else {
            return 'finish driver appear';
        }
    }
}
