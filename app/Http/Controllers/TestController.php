<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function index()
    {
        $image = Image::find(1);
        return view('test')->with('image', $image);
    }
}
