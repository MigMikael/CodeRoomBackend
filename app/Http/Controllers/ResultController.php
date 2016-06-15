<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddResultRequest;
use App\Result;
use App\Http\Requests;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::all();
        
        return view('results.index')->with('results', $results);
    }
    
    public function all()
    {
        $allResult = [];
        $results = Result::all();

        foreach($results as $result) {
            $final_json = self::convertToJson($result);
            array_push($allResult, $final_json);
        }
        return $allResult;
    }

    public function latest()
    {
        $result = Result::all()->last();

        $final_json = self::convertToJson($result);

        return $final_json;
    }

    public function getById($id)
    {
        $result = Result::find($id);

        if (is_null($result)) {
            abort(404);
        }

        $final_json = self::convertToJson($result);

        return $final_json;
    }

    public function convertToJson($result)
    {
        $json = [];
        $classes = explode('|', $result['class']);
        $attributes = explode('|', $result['attribute']);
        $methods = explode('|', $result['method']);
        $tmp = [];
        $tmp['class'] = [];
        $i = 0;
        foreach ($classes as $class) {
            $tmp2 = explode(':', $class);
            $tmp3['name'] = $tmp2[0];

            //$tmp3['attribute'] = $attributes[$i];
            $tmp4 = explode(';', $attributes[$i]);
            $attribute = [];
            foreach ($tmp4 as $itme) {
                $tmp5 = explode(':', $itme);
                $tmp6 = [];
                $tmp6['name'] = $tmp5[0];
                $tmp6['status'] = $tmp5[1];
                array_push($attribute, $tmp6);
            }
            $tmp3['attribute'] = $attribute;

            //$tmp3['method'] = $methods[$i];
            $tmp4 = explode(';', $methods[$i]);
            $method = [];
            foreach ($tmp4 as $tem) {
                $tmp5 = explode(':', $tem);
                $tmp6 = [];
                $tmp6['name'] = $tmp5[0];
                $tmp6['status'] = $tmp5[1];
                array_push($method, $tmp6);
            }
            $tmp3['method'] = $method;

            $tmp3['status'] = $tmp2[1];
            array_push($tmp['class'], $tmp3);

            $i++;
        }
        $json['result'] = $tmp;

        return $json;
    }

    public function create()
    {
        return view('results.create');
    }

    public function store(AddResultRequest $request)    // laravel will tricker validation before execute method
    {
        //$input = Request::all();      //use facade
        $input = $request->all();       //use validation class

        Result::create($input);

        return redirect('results');
    }
}
