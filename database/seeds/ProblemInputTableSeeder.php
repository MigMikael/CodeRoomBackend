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
            'version' => 2,
            'filename' => '1.in',
            'content' => '1',
        ]);

        DB::table('problem_input')->insert([
            'problemfile_id' => 1,
            'version' => 2,
            'filename' => '2.in',
            'content' => '2',
        ]);
    }
}
