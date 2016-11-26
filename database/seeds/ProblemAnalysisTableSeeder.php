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
            'extends' => 'null',
            'implements' => 'null',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('problem_analysis')->insert([
            'problem_id' => 1,
            'class' => 'default;Runner',
            'package' => 'default package',
            'enclose' => 'Runners',
            'extends' => 'null',
            'implements' => 'null',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
