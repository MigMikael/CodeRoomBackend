<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProblemAnalysisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problem_analysis')->insert([
            'problem_id' => 1,
            'class' => 'public;Runners',
            'package' => 'default package',
            'enclose' => 'null',
            'attribute' => 'default;static;int;round|default;static;float;time|',
            'constructor' => 'null',
            'method' => 'public;void;printTest()|',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('problem_analysis')->insert([
            'problem_id' => 1,
            'class' => 'default;Runner',
            'package' => 'default package',
            'enclose' => 'Runners',
            'attribute' => 'default;;int;no|default;;int;speed|default;;float;wasteTime|default;;float;totalTime|',
            'constructor' => 'null',
            'method' => 'public;int;getNo()|public;void;setNo()|public;int;getSpeed()|public;void;setSpeed(int no)|public;float;getWasteTime()|public;void;setWasteTime(float wasteTime)|public;float;getTotalTime()|public;void;setTotalTime(float totalTime)|',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
