<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use App\Http\Requests;

class ResultController extends Controller
{
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
            abort();
        }

        $final_json = self::convertToJson($result);

        return $final_json;
    }

    public function convertToJson($result)
    {
        $json = [];
        $classes = explode(":", $result['class']);
        $json['name'] = $classes[0];

        $attrubutes = explode(";", $result['attribute']);
        $allAttribute = [];
        foreach ($attrubutes as $attrubute) {
            $tmp = explode(":", $attrubute);
            $tmp2 = [];
            $tmp2['name'] = $tmp[0];
            $tmp2['status'] = $tmp[1];
            array_push($allAttribute, $tmp2);
        }
        $json['attribute'] = $allAttribute;

        $methods = explode(";", $result['method']);
        $allMethod = [];
        foreach ($methods as $method) {
            $tmp = explode(":", $method);
            $tmp2 = [];
            $tmp2['name'] = $tmp[0];
            $tmp2['status'] = $tmp[1];
            array_push($allMethod, $tmp2);
        }
        $json['method'] = $allMethod;

        $json['status'] = $classes[1];

        $final_json = [];
        $final_json['class'] = $json;

        return $final_json;
    }
}
