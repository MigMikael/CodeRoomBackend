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

        if(Request::hasFile('file')){
            $submission = Submission::create($submission);
            $file = Request::file('file');
            $msg = self::sendToSubmissionFile($submission, $file);

            if($msg == 'finish driver appear'){
                $hasDriver = true;
            }
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

        $currentIP = 'http://172.27.225.120:3000';
        $problem = $submission->problem;

        if(!$hasDriver){
            //Log::info('##### This Submission not have driver');
            $data = self::getInputVersion($problem, $currentIP);
            if($data['in'] == null || $data['in'][0]['version'] != $currentVersion){
                self::sendTeacherInput($problem, $currentIP);
            }

            $data = self::getOutputVersion($problem, $currentIP);
            if($data['sol'] == null || $data['sol'][0]['version'] != $currentVersion){
                self::sendTeacherOutput($problem, $currentIP);
            }

            $scores = self::sendStudentFile($submission, $currentIP);
            self::keepSubmissionScore($scores, $submission);
        } else {
            //Log::info('##### This Submission have driver');
            /*$data = self::getInputVersion2($problem, $currentIP);
            if($data['in'] == null || $data['in'][0]['version'] != $currentVersion){
                self::sendTeacherInput2($problem, $currentIP);
            }

            $data = self::getOutputVersion2($problem, $currentIP);
            if($data['sol'] == null || $data['sol'][0]['version'] != $currentVersion){
                self::sendTeacherOutput2($problem, $currentIP);
            }*/

            return self::sendDriver($problem, $currentIP);
        }

        //return $scores;


        /*if($problem->is_parse == 'true'){
            self::analyzeSubmission();
            self::keepResult();
            self::calculateScore();
        }*/
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
        return back();
    }

    public function sendToSubmissionFile($submission, $file)
    {
        $submissionFile = [
            'submission_id' => $submission->id,
            'problem_name' => $submission->problem->name,
            'file' => $file,
        ];

        $request = Request::create('submissionfile', 'POST', $submissionFile);

        $res = app()->handle($request);
        $result = $res->getContent();
        return $result;
    }

    public function getInputVersion($problem, $currentIP)
    {
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

    public function getInputVersion2($problem, $currentIP)
    {
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

    public function getOutputVersion($problem, $currentIP)
    {
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

    public function getOutputVersion2($problem, $currentIP)
    {
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

    public function sendTeacherInput($problem, $currentIP)
    {
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

    public function sendTeacherInput2($problem, $currentIP)
    {
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

    public function sendTeacherOutput($problem, $currentIP)
    {
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

    public function sendTeacherOutput2($problem, $currentIP)
    {
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

    public function sendDriver($problem, $currentIP)
    {
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

    public function sendStudentFile($submission, $currentIP)
    {
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

    public function sendStudentFile2($submission, $currentIP)
    {

    }

    public function keepSubmissionScore($scores, $submission)
    {
        $submissionFiles = $submission->submissionFiles;
        foreach ($submissionFiles as $submissionFile){
            $problemFile = ProblemFile::where('filename', '=', $submissionFile->filename)->first();
            //Log::info('##### '. $problemFile->filename);
            $problemOutputNum = ProblemInput::where('problemfile_id', '=', $problemFile->id)->count();

            if($problemOutputNum > 0){
                foreach ($scores as $score){
                    $submissionOutput = [
                        'submissionfile_id' => $submissionFile->id,
                        'score' => $score['score'],
                    ];
                    $submissionOutput = SubmissionOutput::create($submissionOutput);
                }
            }
        }
    }
    //Todo rewrite this method
    public function analyzeSubmission($submission_id, $input_code)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:3000/api/student/code', ['json' => [
                'prob_id' => $submission_id,
                'filename' => 'Test',
                'package' => 'default package',
                'code' => $input_code
            ]
        ]);
        $result = $res->getBody();
        $json = json_decode($result, true);

        Log::info('#### STATUS #### 2 Analyze Submission ####');
        Log::info('#### Data From Evaluator : '. $res->getBody());

        return $json;
    }

    public function keepResult()
    {

    }

    public function calculateScore()
    {

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

}
