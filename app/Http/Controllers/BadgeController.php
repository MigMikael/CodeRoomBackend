<?php

namespace App\Http\Controllers;

use App\Badge;
use Illuminate\Http\Request;
use Log;
use App\Http\Requests;

class BadgeController extends Controller
{
    public function getStudent($badge_id)
    {
        $badge = Badge::find($badge_id);
        Log::info('**** '.$badge->name);
        $students = $badge->students()->get();
        return $students;
    }
}
