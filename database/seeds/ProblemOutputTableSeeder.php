<?php

use Illuminate\Database\Seeder;

class ProblemOutputTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problem_output')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '1.sol',
            'content' => '2376',
        ]);

        DB::table('problem_output')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '2.sol',
            'content' => '2543',
        ]);

        DB::table('problem_output')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '3.sol',
            'content' => '2537',
        ]);

        DB::table('problem_output')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '4.sol',
            'content' => '2310',
        ]);

        DB::table('problem_output')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '5.sol',
            'content' => '2112',
        ]);

        DB::table('problem_output')->insert([
            'problemfile_id' => 1,
            'version' => 1,
            'filename' => '6.sol',
            'content' => '2555',
        ]);
    }
}
