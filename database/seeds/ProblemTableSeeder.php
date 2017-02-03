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
            'name' => 'SigmoidFunction',
            'description' => 'ฝึกฝนการใช้ if-else',
            'evaluator' => 'java',
            'timelimit' => 1,
            'memorylimit' => 32000,
            'is_parse' => 'false',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('problem')->insert([
            'lesson_id' => 1,
            'name' => 'StudentRecord',
            'description' => 'ฝึกฝนการใช้ if-else',
            'evaluator' => 'java',
            'timelimit' => 1,
            'memorylimit' => 32000,
            'is_parse' => 'false',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('problem')->insert([
            'lesson_id' => 1,
            'name' => 'Prototype',
            'description' => 'ฝึกฝนการใช้ if-else',
            'evaluator' => 'java',
            'timelimit' => 1,
            'memorylimit' => 32000,
            'is_parse' => 'false',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('problem')->insert([
            'lesson_id' => 1,
            'name' => 'Runners',
            'description' => 'ฝึกฝนการใช้ if-else',
            'evaluator' => 'java',
            'timelimit' => 1,
            'memorylimit' => 32000,
            'is_parse' => 'true',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('problem')->insert([
            'lesson_id' => 1,
            'name' => 'PrimeNumber',
            'description' => 'ฝึกทักษะการใช้ Loop',
            'evaluator' => 'java',
            'timelimit' => 1,
            'memorylimit' => 32000,
            'is_parse' => 'true',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
