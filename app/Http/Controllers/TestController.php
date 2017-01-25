<?php

namespace App\Http\Controllers;

use App\Helper\TokenGenerate;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Http\Requests;
use Log;

class TestController extends Controller
{
    public function index()
    {
        $image = Image::find(1);
        return view('test')->with('image', $image);
    }

    public function getFile($folderName)
    {
        $allCodes = [];
        $files = Storage::disk('public')->allFiles($folderName.'/RMpractice/src');
        foreach ($files as $file){
            $c = (string)(Storage::disk('public')->get($file));
            //echo $c.'<br>'.'<hr>';
            $code = [
                'filename' => (string)$file,
                'code' => $c,
            ];
            array_push($allCodes, $code);
        }
        return $allCodes;
        //return (new Response($files, 200))->header('Content-Type', 'image/png');
    }

    public function testStrPos()
    {
        /*$msg = '1_Queue_sol.txt';
        if(strpos($msg, 'in') != false){
            echo 'This is in file';
        } else {
            echo 'This is sol file';
        }*/

        $msg = 'LinkedList.java';
        $msg1 = 'dataStructures/LinkedList.java';
        $msg2 = 'com/amela/BookStore.java';
        $temps = explode('/', $msg);

        echo $temps[0];
    }

    public function testTemplate2()
    {
        echo env('CURRENT_IP');
        //return view('template2');
    }

    public function testToken()
    {
        $generator = new TokenGenerate();

        $token = $generator->generate(32);

        return $token;

        /*$hash = password_hash('mig39525G', PASSWORD_DEFAULT);
        echo $hash;

        if(password_verify('mig39525G', $hash)){
            echo 'Password is correct';
        }else {
            echo 'Password is incorrect';
        }*/
    }

    public function getUserProfile(Request $request)
    {
        if($request->session()->has('userID')){
            echo $request->session()->get('userID').'<br>';
            echo $request->session()->get('userRole');
        }else{
            echo 'Now has no session';
        }
    }


}
