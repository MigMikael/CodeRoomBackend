<?php

use Illuminate\Database\Seeder;

class ProblemScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problem_score')->insert([
            'analysis_id' => 1,
            'class' => 10,
            'package' => 10,
            'enclose' => 0,
            'extends' => 0,
            'implements' => 0,
        ]);

        DB::table('problem_score')->insert([
            'analysis_id' => 2,
            'class' => 10,
            'package' => 10,
            'enclose' => 10,
            'extends' => 'null',
            'implements' => 'null',
        ]);
    }
}
