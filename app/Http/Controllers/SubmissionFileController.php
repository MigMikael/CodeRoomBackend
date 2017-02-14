<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Constructor;
use App\Method;
use App\ProblemAnalysis;
use App\ProblemFile;
use App\Result;
use App\ResultAttribute;
use App\ResultConstructor;
use App\ResultMethod;
use App\ResultScore;
use App\Submission;
use App\SubmissionFile;
use Request;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use Log;
use GuzzleHttp\Client;

class SubmissionFileController extends Controller
{
    public function store()
    {
        $submission_id = Request::get('submission_id');
        $problem_name = Request::get('problem_name');
        $file = Request::get('file');
        $currentIP = Request::get('currentIP');

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

                $submissionFile = [
                    'submission_id' => $submission_id,
                    'package' => $packageName,
                    'filename' => $fileName,
                    'mime' => 'java',
                    'code' => Storage::disk('public')->get($file),
                ];
                $submissionFile = SubmissionFile::create($submissionFile);

                $submission = $submissionFile->submission;
                $problem = $submission->problem;
                if($problem->is_parse == 'true'){
                    $classes = self::analyzeSubmission($submissionFile, $currentIP);
                    self::keepResult($submissionFile, $classes);
                    self::calculateScore($submissionFile);
                }
            }
        }
        //Todo Delete zip file when finish (permission deny)
        //Storage::disk('public')->delete('submission_'.$submission_id.'.'.$extension);
        //unlink($filePath);

        return 'finish';
    }

    // Todo continue | store2 >> sendToSubmissionFile2 >> this.store2(below)
    public function store2()
    {
        $submission_id = Request::get('submission_id');
        $problem_name = Request::get('problem_name');
        $files = Request::get('files');
        $currentIP = Request::get('currentIP');

        foreach ($files as $file){
            $f = [
                'submission_id' => $submission_id,
                'package' => $file['package'],
                'filename' => $file['filename'],
                'mime' => 'java',
                'code' => $file['code'],
            ];
            $submissionFile = SubmissionFile::create($f);

            $submission = $submissionFile->submission;
            $problem = $submission->problem;
            if($problem->is_parse == 'true'){
                $classes = self::analyzeSubmission($submissionFile, $currentIP);
                self::keepResult($submissionFile, $classes);
                self::calculateScore($submissionFile);
            }
        }

        return 'finish';
    }

    public function analyzeSubmission($submissionFile, $currentIP)
    {
        $codes = [];
        array_push($codes, $submissionFile->code);

        $client = new Client();
        $res = $client->request('POST', $currentIP.'/api/student/code', ['json' => [
                'code' => $codes,
            ]
        ]);

        $result = $res->getBody();
        $json = json_decode($result, true);
        Log::info('#### Data From Evaluator : '. $res->getBody());

        return $json;
    }

    public function keepResult($submissionFile, $classes)
    {
        foreach ($classes['class'] as $class){
            $im = '';
            foreach ($class['implements'] as $implement){
                $im .= $implement['name'];
            }

            $result = [
                'submissionfile_id' => $submissionFile->id,
                'class' => $class['modifier'].';'.$class['static_required'].';'.$class['name'],
                'enclose' => $class['enclose'],
                'extends' => $class['extends'],
                'implements' => $im,
            ];
            $result = Result::create($result);

            foreach ($class['constructure'] as $constructor){
                $pa = '';
                foreach ($constructor['params'] as $param){
                    $pa .= $param['datatype'].';'.$param['name'].'|';
                }

                $con = [
                    'result_id' => $result->id,
                    'access_modifier' => $constructor['modifier'],
                    'name' => $constructor['name'],
                    'parameter' => $pa
                ];
                ResultConstructor::create($con);
            }

            foreach ($class['attribute'] as $attribute){
                $att = [
                    'result_id' => $result->id,
                    'access_modifier' => $attribute['modifier'],
                    'non_access_modifier' => $attribute['static_required'],
                    'data_type' => $attribute['datatype'],
                    'name' => $attribute['name']
                ];
                ResultAttribute::create($att);
            }

            foreach ($class['method'] as $method){
                $pa = '';
                foreach ($method['params'] as $param){
                    $pa .= $param['datatype'].';'.$param['name'].'|';
                }

                $me = [
                    'result_id' => $result->id,
                    'access_modifier' => $method['modifier'],
                    'non_access_modifier' => $method['static_required'],
                    'return_type' => $method['return_type'],
                    'name' => $method['name'],
                    'parameter' => $pa,
                    'recursive' => $method['recursive'],
                    'loop' => $method['loop_exist']
                ];
                ResultMethod::create($me);
            }
        }
    }

    public function calculateScore($submissionFile)
    {
        $submission = $submissionFile->submission;
        $problem = $submission->problem;

        foreach ($submissionFile->results as $result){
            $problemAnalysis = ProblemAnalysis::where('class', '=', $result->class)->first();

            $this_problem = $problemAnalysis->problemFile->problem;
            if($problem->id != $this_problem->id){
                $problemAnalysis = null;
            }

            if($problemAnalysis != null){
                $class_score = $problemAnalysis->score->class;
                if($result->package == $problemAnalysis->package){
                    $package_score = $problemAnalysis->score->package;
                }else{
                    $package_score = 0;
                }

                if($result->enclose == $problemAnalysis->enclose){
                    $enclose_score = $problemAnalysis->score->enclose;
                }else{
                    $enclose_score = 0;
                }

                if($result->extends == $problemAnalysis->extends){
                    $extends_score = $problemAnalysis->score->extends;
                }else{
                    $extends_score = 0;
                }

                if($result->implements == $problemAnalysis->implements){
                    $implements_score = $problemAnalysis->score->extends;
                }else{
                    $implements_score = 0;
                }
            }else{
                $class_score = 0;
                $package_score = 0;
                $enclose_score = 0;
                $extends_score = 0;
                $implements_score = 0;
            }
            $result_score = [
                'result_id' => $result->id,
                'class' => $class_score,
                'package' => $package_score,
                'enclose' => $enclose_score,
                'extends' => $extends_score,
                'implements' => $implements_score
            ];
            /*Log::info('-------------------------------------------------------------');
            Log::info('##### CLASS NAME'. $result->class);
            Log::info('-------------------------------------------------------------');
            Log::info('##### CLASS SCORE '. $class_score);
            Log::info('##### ENCLOSE SCORE '. $enclose_score);
            Log::info('##### EXTENDS SCORE '. $extends_score);
            Log::info('##### IMPLEMENTS SCORE '. $implements_score);
            Log::info('-------------------------------------------------------------');*/
            ResultScore::create($result_score);

            foreach ($result->attributes as $attribute){
                $prob_attr = Attribute::where('name', '=', $attribute->name)->first();
                if($prob_attr != null){
                    $this_problem = $prob_attr->problemAnalysis->problemFile->problem;
                }else {
                    $this_problem->id = 0;
                }
                if($problem->id != $this_problem->id){
                    $prob_attr = null;
                }

                $correct = true;
                if($prob_attr != null){
                    if($attribute->access_modifier != $prob_attr->access_modifier){
                        $correct = false;
                    } elseif ($attribute->non_access_modifier != $prob_attr->non_access_modifier){
                        $correct = false;
                    } elseif ($attribute->data_type != $prob_attr->data_type){
                        $correct = false;
                    }
                }else{
                    $correct = false;
                }

                if($correct){
                    $attribute->score = $prob_attr->score;
                }else{
                    $attribute->score = 0;
                }
                $attribute->save();
                /*Log::info('Attribute IS CORRECT '. $correct);

                Log::info('-------------------------------------------------------------');
                Log::info('##### ATTRIBUTE NAME'. $attribute->name);
                Log::info('-------------------------------------------------------------');
                Log::info('##### ATTRIBUTE Access Modifier :'. $attribute->access_modifier.'5555');
                Log::info('##### ATTRIBUTE Non Access Modifier '. $attribute->non_access_modifier);
                Log::info('##### ATTRIBUTE Data Type '. $attribute->data_type);


                Log::info('##### P ATTRIBUTE NAME'. $prob_attr->name);
                Log::info('-------------------------------------------------------------');
                Log::info('##### P ATTRIBUTE Access Modifier :'. $prob_attr->access_modifier.'5555');
                Log::info('##### P ATTRIBUTE Non Access Modifier '. $prob_attr->non_access_modifier);
                Log::info('##### P ATTRIBUTE Data Type '. $prob_attr->data_type);
                Log::info('-------------------------------------------------------------');*/
            }

            foreach ($result->constructors as $constructor){
                $prob_con = Constructor::where('name', '=', $constructor->name)->first();
                if($prob_con != null){
                    $this_problem = $prob_con->problemAnalysis->problemFile->problem;
                }else {
                    $this_problem->id = 0;
                }
                if($problem->id != $this_problem->id){
                    $prob_con = null;
                }

                $is_correct = true;
                if($prob_con != null){
                    if($constructor->access_modifiler != $prob_con->access_modifiler){
                        $is_correct = false;
                    } elseif ($constructor->parameter != $prob_con->parameter){
                        $is_correct = false;
                    }
                }else {
                    $is_correct = false;
                }

                if($is_correct){
                    $constructor->score = $prob_con->score;
                }else{
                    $constructor->score = 0;
                }
                $constructor->save();

                //Log::info('Constructor IS CORRECT '. $is_correct);

            }

            foreach ($result->methods as $method){
                $prob_me = Method::where('name', '=', $method->name)->first();
                if($prob_me != null){
                    $this_problem = $prob_me->problemAnalysis->problemFile->problem;
                } else {
                    $this_problem->id = 0;
                }
                if($problem->id != $this_problem->id){
                    $prob_me = null;
                }

                $is_correct = true;
                if($prob_me != null){
                    if($method->access_modifiler != $prob_me->access_modifiler){
                        $is_correct = false;
                    } elseif ($method->non_access_modifiler != $prob_me->non_access_modifiler){
                        $is_correct = false;
                    } elseif ($method->return_type != $prob_me->return_type){
                        $is_correct = false;
                    } elseif ($method->recursive != $prob_me->recursive){
                        $is_correct = false;
                    } elseif ($method->loop != $prob_me->loop){
                        $is_correct = false;
                    } elseif ($method->parameter != $prob_me->parameter){
                        $is_correct = false;
                    }
                } else {
                    $is_correct = false;
                }

                if($is_correct){
                    $method->score = $prob_me->score;
                }else{
                    $method->score = 0;
                }
                $method->save();

                //Log::info('Method IS CORRECT '. $is_correct);
            }
        }
    }
}
