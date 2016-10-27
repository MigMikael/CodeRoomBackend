<?php
/**
 * Created by PhpStorm.
 * User: Mig
 * Date: 10/25/2016
 * Time: 20:48
 */
    /*$your_text = "Helloooo Worldddd";
    $IMG = imagecreate( 500, 500 );
    $background = imagecolorallocate($IMG, 63,81,181);
    $text_color = imagecolorallocate($IMG, 255,255,0);
    $line_color = imagecolorallocate($IMG, 128,255,0);
    $frame_color = imagecolorallocate($IMG, 255, 255, 255);
    imagestring( $IMG, 10, 1, 25, $your_text,  $text_color );
    imagesetthickness ( $IMG, 5 );
    imageline( $IMG, 0, 250, 500, 250, $line_color );
    imagerectangle( $IMG, 10, 10, 490, 490, $frame_color);
    imagefilledellipse( $IMG, 250, 250, 450, 450, $frame_color);
    header( "Content-type: image/png" );
    imagepng($IMG);
    imagecolordeallocate($IMG, $frame_color);
    imagecolordeallocate($IMG, $line_color );
    imagecolordeallocate($IMG, $text_color );
    imagecolordeallocate($IMG, $background );
    imagedestroy($IMG);
    exit;*/


    $text = 'CP';
    $font = 'C:\Users\Mig\Desktop\arial.ttf';
    $IMG = imagecreate( 500, 500 );
    $background = imagecolorallocate($IMG, 255, 255, 255);
    $text_color = imagecolorallocate($IMG, 255, 255, 255);
    $circle_color = imagecolorallocate($IMG, 63, 81, 181);
    $inner_circle_color = imagecolorallocate($IMG, 255, 255, 255);

    imagefilledellipse($IMG, 250, 250, 500, 500, $circle_color);
    imagefilledellipse($IMG, 250, 250, 470, 470, $inner_circle_color);
    imagefilledellipse($IMG, 250, 250, 440, 440, $circle_color);
    imagettftext($IMG, 150, 0, 130, 320, $text_color, $font, $text);
    //imagestring($IMG, 5, 250, 250, $text, $text_color);

    header('Content-type: image/png');
    imagepng($IMG);

    imagecolordeallocate($IMG, $inner_circle_color);
    imagecolordeallocate($IMG, $circle_color);
    imagecolordeallocate($IMG, $text_color);
    imagecolordeallocate($IMG, $background);
    imagedestroy($IMG);
    exit;
?>