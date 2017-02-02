<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubmissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submission')->insert([
            'student_id' => '1',
            'problem_id' => '4',
            'sub_num' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
