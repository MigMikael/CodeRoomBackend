<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Log;
use App\Http\Requests;

class ImageController extends Controller
{
    /*
    $r = rand(0, 255);
    $g = rand(0, 255);
    $b = rand(0, 255);
    */

    public function genLessonBadgeImage($course_name, $lesson_name, $color)
    {
        // $course = computer_programming
        $words = explode('_', $course_name);
        $text = '';
        for($i = 0; $i < 2; $i++){
            $text .= substr($words[$i], 0, 1);
        }
        $lesson_name = str_replace('_', ' ', $lesson_name);
        $text .= ':'.$lesson_name;
        $bg = 255;

        $image = [
            'height' => 500,
            'width' => 500,
            'background_color' => $color,
            'foreground_color' => $bg.':'.$bg.':'.$bg,
            'text' => $text,
            'type' => 'lesson_badge',
        ];

        $image = Image::create($image);
        return $image->id;
    }

    public function genNormalBadgeImage($course_name, $criteria, $color)
    {
        $words = explode('_', $course_name);
        $text = '';
        for($i = 0; $i < 2; $i++){
            $text .= substr($words[$i], 0, 1);
        }
        $criteria = str_replace('_', ' ', $criteria);
        $text .= ':'.$criteria;
        $bg = 255;

        $image = [
            'height' => 500,
            'width' => 500,
            'background_color' => $color,
            'foreground_color' => $bg.':'.$bg.':'.$bg,
            'text' => $text,
            'type' => 'normal_badge',
        ];

        $image = Image::create($image);
        return $image->id;
    }


    public function getImage($id)
    {
        $image = Image::find($id);
        if($image->type == 'lesson_badge'){
            self::drawLessonBadge($image);
        }
        elseif ($image->type == 'normal_badge'){
            self::drawNormalBadge($image);
        }
    }

    public function drawLessonBadge($image)
    {
        $texts = explode(':', $image->text);
        $course_name = $texts[0];
        $lesson_name = $texts[1];
        $course_name = strtoupper($course_name);
        $font = public_path().'\font\arial.ttf';
        $IMG = imagecreate( $image->height, $image->width );

        $colors = explode(':', $image->background_color);
        $r = $colors[0];
        $g = $colors[1];
        $b = $colors[2];

        $background = imagecolorallocate($IMG, 255, 255, 255);
        $text_color = imagecolorallocate($IMG, 255, 255, 255);
        $circle_color = imagecolorallocate($IMG, $r, $g, $b);
        $inner_circle_color = imagecolorallocate($IMG, 255, 255, 255);

        imagefilledellipse($IMG, 250, 250, 500, 500, $circle_color);
        imagefilledellipse($IMG, 250, 250, 470, 470, $inner_circle_color);
        imagefilledellipse($IMG, 250, 250, 440, 440, $circle_color);
        imagettftext($IMG, 150, 0, 130, 320, $text_color, $font, $course_name);
        imagettftext($IMG, 20, 0, 200, 400, $text_color, $font, $lesson_name);
        //imagestring($IMG, 5, 200, 400, $lesson_name, $text_color);
        header('Content-type: image/png');
        imagepng($IMG);

        imagecolordeallocate($IMG, $inner_circle_color);
        imagecolordeallocate($IMG, $circle_color);
        imagecolordeallocate($IMG, $text_color);
        imagecolordeallocate($IMG, $background);
        imagedestroy($IMG);
    }

    public function drawNormalBadge($image)
    {
        $texts = explode(':', $image->text);
        $course_name = $texts[0];
        $criteria = $texts[1];
        $course_name = strtoupper($course_name);
        $font = public_path().'\font\arial.ttf';
        $IMG = imagecreate( $image->height, $image->width );

        $colors = explode(':', $image->background_color);
        $r = $colors[0];
        $g = $colors[1];
        $b = $colors[2];

        $background = imagecolorallocate($IMG, 255, 255, 255);
        $text_color = imagecolorallocate($IMG, 255, 255, 255);
        $rectangle_color = imagecolorallocate($IMG, $r, $g, $b);
        $inner_rectangle_color = imagecolorallocate($IMG, 255, 255, 255);

        imagefilledrectangle($IMG, 0, 0, 500, 500, $rectangle_color);
        imagefilledrectangle($IMG, 20, 20, 480, 480, $inner_rectangle_color);
        //imagefilledrectangle($IMG, 40, 40, 460, 460, $rectangle_color);
        // Todo Why above line got error?
        //imagefilledellipse($IMG, 250, 250, 500, 500, $circle_color);
        //imagefilledellipse($IMG, 250, 250, 470, 470, $inner_circle_color);
        imagefilledellipse($IMG, 250, 250, 430, 430, $rectangle_color);
        imagettftext($IMG, 150, 0, 130, 320, $text_color, $font, $course_name);
        imagettftext($IMG, 20, 0, 200, 400, $text_color, $font, $criteria);
        header('Content-type: image/png');
        imagepng($IMG);

        imagecolordeallocate($IMG, $inner_rectangle_color);
        imagecolordeallocate($IMG, $rectangle_color);
        imagecolordeallocate($IMG, $text_color);
        imagecolordeallocate($IMG, $background);
        imagedestroy($IMG);
    }
}
