<?php

use Illuminate\Database\Seeder;

class ProblemFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problemfile')->insert([
            'problem_id' => 1,
            'package' => 'default package',
            'filename' => 'Runners.java',
            'mime' => 'java',
            'code' => '',
        ]);
    }
}
