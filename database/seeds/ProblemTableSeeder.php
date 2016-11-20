<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProblemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problem')->insert([
            'lesson_id' => 1,
            'name' => 'Runners',
            'description' => 'ฝึกฝนการใช้ if-else',
            'evaluator' => 'java',
            'timelimit' => 1,
            'memorylimit' => 3,
            'is_parse' => 'true',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('problem')->insert([
            'lesson_id' => 1,
            'name' => 'Runners2',
            'description' => 'ฝึกฝนการเขียนโค้ดที่มีประสิทธิภาพ',
            'evaluator' => 'java',
            'timelimit' => 1,
            'memorylimit' => 1,
            'is_parse' => 'true',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
