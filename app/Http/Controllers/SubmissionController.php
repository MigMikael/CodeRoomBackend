<?php

namespace App\Http\Controllers;

use App\ProblemAnalysis;
use App\ProblemFile;
use App\ProblemInput;
use App\Result;
use App\Submission;
use App\SubmissionFile;
use App\SubmissionOutput;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Request;
use GuzzleHttp\Client;
use App\Http\Requests;
use Log;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::all()->sortByDesc('created_at');
        foreach ($submissions as $submission){
            $submission->student;
            $submission->code = '';
        }
        return view('submission.index')->with('submissions', $submissions);
        //return $submissions;
    }

    public function create()
    {
        return view('submission.create');
    }

    public function store()
    {
        $student_id = Request::get('student_id');
        $problem_id = Request::get('problem_id');

        $sub_num = self::getSubNum($student_id, $problem_id);

        $submission = [
            'student_id' => $student_id,
            'problem_id' => $problem_id,
            'sub_num' => $sub_num,
        ];
        $hasDriver = false;

        $submission = Submission::create($submission);
        $problem = $submission->problem;
        $problemFiles = $problem->problemFiles;
        foreach ($problemFiles as $problemFile){
            if($problemFile->package == 'driver'){
                $hasDriver = true;
            }
        }

        if(Request::hasFile('file')){
            $file = Request::file('file');
            self::sendToSubmissionFile($submission, $file);
        } else {
            return 'file not found';
        }

        $currentVersion = 0;
        $problemFiles = $submission->problem->problemFiles;
        foreach ($problemFiles as $problemFile){
            if(sizeof($problemFile->inputs) > 0){
                $input = $problemFile->inputs()->first();
                $currentVersion = $input->version;
            }
        }

        $problem = $submission->problem;

        //$scores = '';
        if(!$hasDriver){
            //Log::info('##### This Submission not have driver');
            $data = self::getInputVersion($problem);
            if($data['in'] == null || $data['in'][0]['version'] != $currentVersion){
                self::sendTeacherInput($problem);
            }

            $data = self::getOutputVersion($problem);
            if($data['sol'] == null || $data['sol'][0]['version'] != $currentVersion){
                self::sendTeacherOutput($problem);
            }
            $scores = self::sendStudentFile($submission);
            self::keepSubmissionScore($scores, $submission);
        } else {
            //Log::info('##### This Submission have driver');
            $data = self::getInputVersion2($problem);
            if($data['in'] == null || $data['in'][0]['version'] != $currentVersion){
                self::sendTeacherInput2($problem);
            }

            $data = self::getOutputVersion2($problem);
            if($data['sol'] == null || $data['sol'][0]['version'] != $currentVersion){
                self::sendTeacherOutput2($problem);
            }
            self::sendDriver($problem);
            $scores = self::sendStudentFile2($submission);
            self::keepSubmissionScore2($scores, $submission);
        }

        return $scores;
    }

    public function store2()
    {
        $student_id = Request::get('student_id');
        $problem_id = Request::get('problem_id');

        $sub_num = self::getSubNum($student_id, $problem_id);

        $submission = [
            'student_id' => $student_id,
            'problem_id' => $problem_id,
            'sub_num' => $sub_num,
        ];
        $hasDriver = false;

        $submission = Submission::create($submission);
        $problem = $submission->problem;
        $problemFiles = $problem->problemFiles;
        foreach ($problemFiles as $problemFile){
            if($problemFile->package == 'driver'){
                $hasDriver = true;
            }
        }

        // Send to analyze code in each file
        $files = Request::get('files');
        self::sendToSubmissionFile2($submission, $files);

        $currentVersion = 0;
        $problemFiles = $submission->problem->problemFiles;
        foreach ($problemFiles as $problemFile){
            if(sizeof($problemFile->inputs) > 0){
                $input = $problemFile->inputs()->first();
                $currentVersion = $input->version;
            }
        }

        $problem = $submission->problem;

        //$scores = '';
        if(!$hasDriver){
            //Log::info('##### This Submission not have driver');
            $data = self::getInputVersion($problem);
            if($data['in'] == null || $data['in'][0]['version'] != $currentVersion){
                self::sendTeacherInput($problem);
            }

            $data = self::getOutputVersion($problem);
            if($data['sol'] == null || $data['sol'][0]['version'] != $currentVersion){
                self::sendTeacherOutput($problem);
            }
            $scores = self::sendStudentFile($submission);
            self::keepSubmissionScore($scores, $submission);
        } else {
            //Log::info('##### This Submission have driver');
            $data = self::getInputVersion2($problem);
            if($data['in'] == null || $data['in'][0]['version'] != $currentVersion){
                self::sendTeacherInput2($problem);
            }

            $data = self::getOutputVersion2($problem);
            if($data['sol'] == null || $data['sol'][0]['version'] != $currentVersion){
                self::sendTeacherOutput2($problem);
            }
            self::sendDriver($problem);
            $scores = self::sendStudentFile2($submission);
            self::keepSubmissionScore2($scores, $submission);
        }

        foreach ($submission->submissionFiles as $submissionFile){
            $submissionFile->outputs;

            foreach ($submissionFile->results as $result){
                $result->score;
                $result->attributes;
                $result->constructors;
                $result->methods;
            }
        }
        return $submission;
    }

    public function show($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->student;
        $submission->problem;
        $submission->submissionFiles;
        foreach ($submission->submissionFiles as $submissionFile){
            foreach ($submissionFile->results as $result){
                $result->attributes;
                $result->constructors;
                $result->methods;
            }
            $submissionFile->outputs;
        }
        return view('submission.show2')->with('submission', $submission);
        //return $submission;
    }

    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();
        return 'Delete Finish';
    }

    public function sendToSubmissionFile($submission, $file)
    {
        $currentIP = env('CURRENT_IP');
        $submissionFile = [
            'submission_id' => $submission->id,
            'problem_name' => $submission->problem->name,
            'file' => $file,
            'currentIP' => $currentIP,
        ];

        $request = Request::create('submissionfile', 'POST', $submissionFile);

        $res = app()->handle($request);
        $result = $res->getContent();
        return $result;
    }

    public function sendToSubmissionFile2($submission, $files)
    {
        $currentIP = env('CURRENT_IP');
        $submissionFile = [
            'submission_id' => $submission->id,
            'problem_name' => $submission->problem->name,
            'files' => $files,
            'currentIP' => $currentIP,
        ];

        $request = Request::create('submissionfile2', 'POST', $submissionFile);

        $res = app()->handle($request);
        $result = $res->getContent();
        return $result;
    }

    public function getInputVersion($problem)
    {
        $currentIP = env('CURRENT_IP');
        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $client = new Client();
        $url = $currentIP.'/api/teacher/check_in?subject='.$subjectName.'&problem='.$problem->name;
        //$url = 'http://posttestserver.com/post.php?subject='.$subjectName.'&problem='.$problem->name;

        $res = $client->request('GET', $url);
        $result = $res->getBody();
        $json = json_decode($result, true);

        //Log::info('#### getInputVersion '. $res->getBody());
        return $json;
    }

    public function getInputVersion2($problem)
    {
        $currentIP = env('CURRENT_IP');
        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $client = new Client();
        $url = $currentIP.'/api/teacher/check_in_driver?subject='.$subjectName.'&problem='.$problem->name;
        //$url = 'http://posttestserver.com/post.php?subject='.$subjectName.'&problem='.$problem->name;

        $res = $client->request('GET', $url);
        $result = $res->getBody();
        $json = json_decode($result, true);

        //Log::info('#### getInputVersion '. $res->getBody());
        return $json;
    }

    public function getOutputVersion($problem)
    {
        $currentIP = env('CURRENT_IP');
        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $client = new Client();
        $url = $currentIP.'/api/teacher/check_sol?subject='.$subjectName.'&problem='.$problem->name;
        //$url = 'http://posttestserver.com/post.php?subject='.$subjectName.'&problem='.$problem->name;

        $res = $client->request('GET', $url);
        $result = $res->getBody();
        $json = json_decode($result, true);

        //Log::info('#### getOutVersion '. $res->getBody());
        return $json;
    }

    public function getOutputVersion2($problem)
    {
        $currentIP = env('CURRENT_IP');
        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $client = new Client();
        $url = $currentIP.'/api/teacher/check_sol_driver?subject='.$subjectName.'&problem='.$problem->name;
        //$url = 'http://posttestserver.com/post.php?subject='.$subjectName.'&problem='.$problem->name;

        $res = $client->request('GET', $url);
        $result = $res->getBody();
        $json = json_decode($result, true);

        //Log::info('#### getOutVersion '. $res->getBody());
        return $json;
    }

    public function sendTeacherInput($problem)
    {
        $currentIP = env('CURRENT_IP');

        $inputs = [];

        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $inputs['subject'] = $subjectName;
        $inputs['problem'] = $problem->name;
        $inputs['in'] = [];

        foreach ($problem->problemFiles as $problemFile){
            foreach ($problemFile->inputs as $input){
                $realInput = [
                    'version' => $input->version,
                    'filename' => $input->filename,
                    'content' => $input->content,
                ];
                array_push($inputs['in'], $realInput);
            }
        }
        //return $inputs;

        $client = new Client();
        $url = $currentIP.'/api/teacher/send_in';
        //$url = 'http://www.posttestserver.com/post.php';

        $res = $client->request('POST', $url, ['json' => [
                'subject' => $inputs['subject'],
                'problem' => $inputs['problem'],
                'in' => $inputs['in'],
            ]
        ]);

        $result = $res->getBody();
        return $result;
    }

    public function sendTeacherInput2($problem)
    {
        $currentIP = env('CURRENT_IP');

        $inputs = [];

        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $inputs['subject'] = $subjectName;
        $inputs['problem'] = $problem->name;
        $inputs['in'] = [];

        foreach ($problem->problemFiles as $problemFile){
            $temps = explode('.', $problemFile->filename);
            $package = $temps[0];
            foreach ($problemFile->inputs as $input){
                $realInput = [
                    'version' => $input->version,
                    'filename' => $input->filename,
                    'content' => $input->content,
                    'package' => $package
                ];
                array_push($inputs['in'], $realInput);
            }
        }
        //return $inputs;

        $client = new Client();
        $url = $currentIP.'/api/teacher/send_in_driver';
        //$url = 'http://www.posttestserver.com/post.php';

        $res = $client->request('POST', $url, ['json' => [
            'subject' => $inputs['subject'],
            'problem' => $inputs['problem'],
            'in' => $inputs['in'],
        ]
        ]);

        $result = $res->getBody();
        return $result;
    }

    public function sendTeacherOutput($problem)
    {
        $currentIP = env('CURRENT_IP');

        $outputs = [];

        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $outputs['subject'] = $subjectName;
        $outputs['problem'] = $problem->name;
        $outputs['sol'] = [];

        foreach ($problem->problemFiles as $problemFile){
            foreach ($problemFile->outputs as $output){
                $realOutput = [
                    'version' => $output->version,
                    'filename' => $output->filename,
                    'content' => $output->content,
                ];
                array_push($outputs['sol'], $realOutput);
            }
        }
        //return $outputs;

        $client = new Client();
        $url = $currentIP.'/api/teacher/send_sol';
        //$url = 'http://www.posttestserver.com/post.php';

        $res = $client->request('POST', $url, ['json' => [
                'subject' => $outputs['subject'],
                'problem' => $outputs['problem'],
                'sol' => $outputs['sol'],
            ]
        ]);

        $result = $res->getBody();
        return $result;
    }

    public function sendTeacherOutput2($problem)
    {
        $currentIP = env('CURRENT_IP');

        $outputs = [];

        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $outputs['subject'] = $subjectName;
        $outputs['problem'] = $problem->name;
        $outputs['sol'] = [];

        foreach ($problem->problemFiles as $problemFile){
            $temps = explode('.', $problemFile->filename);
            $package = $temps[0];
            foreach ($problemFile->outputs as $output){
                $realOutput = [
                    'version' => $output->version,
                    'filename' => $output->filename,
                    'content' => $output->content,
                    'package' => $package
                ];
                array_push($outputs['sol'], $realOutput);
            }
        }
        //return $outputs;

        $client = new Client();
        $url = $currentIP.'/api/teacher/send_sol_driver';
        //$url = 'http://www.posttestserver.com/post.php';

        $res = $client->request('POST', $url, ['json' => [
            'subject' => $outputs['subject'],
            'problem' => $outputs['problem'],
            'sol' => $outputs['sol'],
        ]
        ]);

        $result = $res->getBody();
        return $result;
    }

    public function sendDriver($problem)
    {
        $currentIP = env('CURRENT_IP');

        $drivers = [];

        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);

        $drivers['subject'] = $subjectName;
        $drivers['problem'] = $problem->name;
        $drivers['driver'] = [];

        foreach ($problem->problemFiles as $problemFile){
            $temps = explode('.', $problemFile->filename);
            $filename = $temps[0];
            if($problemFile->package == 'driver'){
                $numInSol = ProblemInput::where('problemfile_id', '=', $problemFile->id)->count();
                $driver = [
                    'package' => $problemFile->package,
                    'filename' => $filename,
                    'code' => $problemFile->code,
                    'number' => $numInSol
                ];
                array_push($drivers['driver'], $driver);
            }
        }
        //return $drivers;

        $client = new Client();
        $url = $currentIP.'/api/teacher/send_driver';
        //$url = 'http://www.posttestserver.com/post.php';

        $res = $client->request('POST', $url, ['json' => [
            'subject' => $drivers['subject'],
            'problem' => $drivers['problem'],
            'driver' => $drivers['driver'],
        ]
        ]);

        $result = $res->getBody();
        $json = json_decode($result, true);
        return $json;
    }

    public function sendStudentFile($submission)
    {
        $currentIP = env('CURRENT_IP');

        $data = [];
        $problem = $submission->problem;
        $data['time_out'] = strval($problem->timelimit);
        $data['mem_size'] = strval($problem->memorylimit);

        $problemFile = ProblemFile::where('problem_id', '=', $problem->id)->first();
        $data['number'] = ProblemInput::where('problemfile_id', '=', $problemFile->id)->count();

        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);
        $data['subject'] = $subjectName;
        $data['problem'] = $problem->name;

        $data['file'] = [];
        foreach ($submission->submissionFiles as $submissionFile){

            $code = $submissionFile->code;
            $is_main = false;
            $main = strpos($code, 'main');
            if($main != false){
                $args = strpos($code, '(', $main);
                $args1 = strpos($code, 'String', $args);
                $args2 = strpos($code, '[]', $args1);

                if($args != false && $args1 != false && $args2 != false){
                    $is_main = true;
                }
            }

            $package = $submissionFile->package;
            if($package == 'default package'){
                $package = '';
            } else {
                $package = str_replace('.','/', $package);
                $package .= '/';
            }

            $temps = explode('.', $submissionFile->filename);
            $fileName = $temps[0];

            $dataFile = [
                'package' => $package,
                'filename' => $fileName,
                'code' => $submissionFile->code,
                'is_main' => $is_main
            ];
            array_push($data['file'], $dataFile);
        }
        //return $data;

        $client = new Client();
        $url = $currentIP.'/api/teacher/evaluate';
        //$url = 'http://www.posttestserver.com/post.php';
        $res = $client->request('POST', $url, ['json' => [
            'time_out' => $data['time_out'],
            'mem_size' => $data['mem_size'],
            'number' => $data['number'],
            'subject' => $data['subject'],
            'problem' => $data['problem'],
            'file' => $data['file'],
        ]
        ]);

        $result = $res->getBody();
        $json = json_decode($result, true);
        return $json;
    }

    public function sendStudentFile2($submission)
    {
        $currentIP = env('CURRENT_IP');

        $data = [];
        $problem = $submission->problem;
        $data['time_out'] = strval($problem->timelimit);
        $data['mem_size'] = strval($problem->memorylimit);

        $subjectName = $problem->lesson->course->name;
        $subjectName = str_replace(' ', '', $subjectName);
        $subjectName = strtolower($subjectName);
        $data['subject'] = $subjectName;
        $data['problem'] = $problem->name;

        $data['file'] = [];
        foreach ($submission->submissionFiles as $submissionFile){
            $package = $submissionFile->package;
            if($package == 'default package'){
                $package = '';
            } else {
                $package = str_replace('.','/', $package);
                $package .= '/';
            }

            $temps = explode('.', $submissionFile->filename);
            $fileName = $temps[0];

            $dataFile = [
                'package' => $package,
                'filename' => $fileName,
                'code' => $submissionFile->code,
            ];
            array_push($data['file'], $dataFile);
        }
        //return $data;

        $client = new Client();
        $url = $currentIP.'/api/teacher/evaluate_driver';
        //$url = 'http://www.posttestserver.com/post.php';
        $res = $client->request('POST', $url, ['json' => [
            'time_out' => $data['time_out'],
            'mem_size' => $data['mem_size'],
            'subject' => $data['subject'],
            'problem' => $data['problem'],
            'file' => $data['file'],
        ]
        ]);

        $result = $res->getBody();
        $json = json_decode($result, true);
        return $json;
    }

    public function keepSubmissionScore($scores, $submission)
    {
        $submissionFiles = $submission->submissionFiles;
        $isAccept = true;
        foreach ($submissionFiles as $submissionFile){
            $problemFile = ProblemFile::where('filename', '=', $submissionFile->filename)->first();
            //Log::info('##### '. $problemFile->filename);
            $problemOutputNum = ProblemInput::where('problemfile_id', '=', $problemFile->id)->count();

            if($problemOutputNum > 0){
                foreach ($scores as $score){
                    if($score['score'] != 100){
                        $isAccept = false;
                    }
                    $submissionOutput = [
                        'submissionfile_id' => $submissionFile->id,
                        'score' => $score['score'],
                    ];
                    $submissionOutput = SubmissionOutput::create($submissionOutput);
                }
            }
        }
        if ($isAccept == true){
            $submission->is_accept = 'true';
        }else{
            $submission->is_accept = 'false';
        }
        $submission->save();
    }

    public function keepSubmissionScore2($scores, $submission)
    {
        $problem = $submission->problem;
        $problemFiles = $problem->problemFiles;
        $isAccept = true;
        foreach ($problemFiles as $problemFile){
            if($problemFile->package == 'driver'){
                $submissionFile = [
                    'submission_id' => $submission->id,
                    'package' => $problemFile->package,
                    'filename' => $problemFile->filename,
                    'mime' => $problemFile->mime,
                    'code' => 'driver from teacher',
                ];
                $submissionFile = SubmissionFile::create($submissionFile);
                $temps = explode('.',$submissionFile->filename);
                $fileName = $temps[0];

                foreach ($scores as $score){
                    if($score['name'] == $fileName){
                        if($score != 100){
                            $isAccept = false;
                        }
                        $output = [
                            'submissionfile_id' => $submissionFile->id,
                            'content' => '',
                            'score' => $score['score'],
                        ];
                        $output = SubmissionOutput::create($output);
                        //Log::info('#### '.$output->submissionfile_id);
                    }
                }
            }
        }
        if ($isAccept == true){
            $submission->is_accept = 'true';
        }else{
            $submission->is_accept = 'false';
        }
        $submission->save();
    }

    public function storeCode()
    {
        Log::info('###### This is storCode');
        $student_id = Request::get('student_id');
        $problem_id = Request::get('problem_id');
        $sub_num = self::getSubNum($student_id, $problem_id);

        $submission = [
            'student_id' => $student_id,
            'problem_id' => $problem_id,
            'sub_num' => $sub_num,
        ];

        $submission = Submission::create($submission);
        $files = Request::get('files');

        foreach ($files as $file){
            //Log::info('Filename '.$file['filename']);
            $temps = explode('.', $file['filename']);
            $fileName = $temps[0];
            $mime = $temps[1];

            $submissionFile = [
                'submission_id' => $submission->id,
                'package' => $file['name'],
                'filename' => $fileName,
                'mime' => $mime,
                'code' => $file['code']
            ];

            $submissionFile = SubmissionFile::create($submissionFile);
        }
        return 'finish';
    }

    public function getSubNum($student_id, $problem_id)
    {
        $sub_num = DB::table('submission')->where([
            ['student_id', '=', $student_id],
            ['problem_id', '=', $problem_id],
        ])->count();
        $sub_num++;

        return $sub_num;
    }

    public function getSubmissionCode($id)
    {
        $submissionFiles = SubmissionFile::where('submission_id', '=', $id)->get();
        return $submissionFiles;
    }

    public function getResult($problem_id, $student_id)
    {
        $submission = Submission::where([
            ['student_id', '=', $student_id],
            ['problem_id', '=', $problem_id]
        ])->orderBy('id', 'desc')->first();

        if($submission != null){
            foreach ($submission->submissionFiles as $submissionFile){
                $submissionFile->outputs;

                foreach ($submissionFile->results as $result){
                    $result->score;
                    $result->attributes;
                    $result->constructors;
                    $result->methods;
                }
            }
        }else{
            $submission = [];
        }

        return $submission;
    }

}
