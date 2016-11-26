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
    }
}
