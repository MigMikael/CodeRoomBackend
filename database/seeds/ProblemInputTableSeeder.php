<?php

use Illuminate\Database\Seeder;

class ProblemInputTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problem_input')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '1.in',
            'content' => '2376',
        ]);

        DB::table('problem_input')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '2.in',
            'content' => '2543',
        ]);

        DB::table('problem_input')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '3.in',
            'content' => '2537',
        ]);

        DB::table('problem_input')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '4.in',
            'content' => '2310',
        ]);

        DB::table('problem_input')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '5.in',
            'content' => '2112',
        ]);

        DB::table('problem_input')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '6.in',
            'content' => '2555',
        ]);
    }
}
