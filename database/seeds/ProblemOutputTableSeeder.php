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
            'version' => 2,
            'filename' => '1.sol',
            'content' => '0.2689414213699951',
        ]);

        DB::table('problem_output')->insert([
            'problemfile_id' => 1,
            'version' => 2,
            'filename' => '2.sol',
            'content' => '0.11920292202211755',
        ]);
    }
}
