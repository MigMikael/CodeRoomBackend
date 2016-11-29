<?php

use Illuminate\Database\Seeder;

class SubmissionOutputTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submission_output')->insert([
            'submissionfile_id' => 1,
            'content' => '2376',
            'score' => 100,
        ]);

        DB::table('submission_output')->insert([
            'submissionfile_id' => 1,
            'content' => '2543',
            'score' => 100,
        ]);

        DB::table('submission_output')->insert([
            'submissionfile_id' => 1,
            'content' => '2537',
            'score' => 100,
        ]);

        DB::table('submission_output')->insert([
            'submissionfile_id' => 1,
            'content' => '2310',
            'score' => 100,
        ]);

        DB::table('submission_output')->insert([
            'submissionfile_id' => 1,
            'content' => '2112',
            'score' => 100,
        ]);

        DB::table('submission_output')->insert([
            'submissionfile_id' => 1,
            'content' => '2555',
            'score' => 100,
        ]);
    }
}
