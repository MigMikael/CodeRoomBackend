<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Constructor;
use App\Method;
use App\ProblemAnalysis;
use App\ProblemFile;
use App\ProblemInput;
use App\ProblemOutput;
use App\ProblemScore;
use Chumper\Zipper\Zipper;
use Request;
use Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Problem;
use GuzzleHttp\Client;

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
        $currentIP = Request::get('currentIP');
        $version = 1;

        return self::keepFile($problem_id, $problem_name, $file, $version, $currentIP);
    }

    public function edit()
    {
        $problem_id = Request::get('problem_id');
        $problem_name = Request::get('problem_name');
        $file = Request::get('file');
        $currentIP = Request::get('currentIP');

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

        self::keepFile($problem_id, $problem_name, $file, $version, $currentIP);
    }

    public function keepFile($problem_id, $problem_name, $file, $version, $currentIP)
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

                if($problemFile->problem->is_parse == 'true'){
                    $classes = self::analyzeProblemFile($problemFile, $currentIP);
                    self::keepProblemAnalysis($problemFile, $classes);
                }
            }
        }
        return 'finish';
    }

    public function analyzeProblemFile($problemFile ,$currentIP)
    {
        $codes = [];
        array_push($codes, $problemFile->code);

        $client = new Client();
        $res = $client->request('POST', $currentIP.'/api/teacher/required', ['json' => [
                'code' => $codes,
            ]
        ]);

        $result = $res->getBody();
        $json = json_decode($result, true);
        Log::info('#### Data From Evaluator : '. $res->getBody());

        return $json;
    }

    public function keepProblemAnalysis($problemFile, $classes)
    {
        foreach ($classes['class'] as $class){
            $im = '';
            foreach ($class['implements'] as $implement){
                $im .= $implement['name'];
            }

            $problemAnalysis = [
                'problemfile_id' => $problemFile->id,
                'class' => $class['modifier'].';'.$class['static_required'].';'.$class['name'],
                'enclose' => $class['enclose'],
                'extends' => $class['extends'],
                'implements' => $im,
            ];
            $problemAnalysis = ProblemAnalysis::create($problemAnalysis);

            $problem_score = [
                'analysis_id' => $problemAnalysis->id,
                'class' => 0,
                'package' => 0,
                'enclose' => 0,
                'extends' => 0,
                'implements' => 0,
            ];
            ProblemScore::create($problem_score);

            foreach ($class['constructure'] as $constructor){
                $pa = '';
                foreach ($constructor['params'] as $param){
                    $pa .= $param['datatype'].';'.$param['name'].'|';
                }

                $con = [
                    'analysis_id' => $problemAnalysis->id,
                    'access_modifier' => $constructor['modifier'],
                    'name' => $constructor['name'],
                    'parameter' => $pa
                ];
                Constructor::create($con);
            }

            foreach ($class['attribute'] as $attribute){
                $att = [
                    'analysis_id' => $problemAnalysis->id,
                    'access_modifier' => $attribute['modifier'],
                    'non_access_modifier' => $attribute['static_required'],
                    'data_type' => $attribute['datatype'],
                    'name' => $attribute['name']
                ];
                Attribute::create($att);
            }

            foreach ($class['method'] as $method){
                $pa = '';
                foreach ($method['params'] as $param){
                    $pa .= $param['datatype'].';'.$param['name'].'|';
                }

                $me = [
                    'analysis_id' => $problemAnalysis->id,
                    'access_modifier' => $method['modifier'],
                    'non_access_modifier' => $method['static_required'],
                    'return_type' => $method['return_type'],
                    'name' => $method['name'],
                    'parameter' => $pa,
                    'recursive' => $method['recursive'],
                    'loop' => $method['loop_exist']
                ];
                Method::create($me);
            }
        }
    }

    public function getQuestion($problem_id)
    {
        $problem = Problem::findOrFail($problem_id);
        $questionPath = '/'.$problem->id.'_'.$problem->name.'/'.$problem->name.'/question/'.$problem->name.'.pdf';
        $question = Storage::disk('public')->get($questionPath);

        return (new Response($question, 200))->header('Content-Type', 'application/pdf');
    }
}
