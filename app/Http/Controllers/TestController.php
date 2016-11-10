<?php

namespace App\Http\Controllers;

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
}
