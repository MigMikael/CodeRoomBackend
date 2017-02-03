<?php

use Illuminate\Database\Seeder;

class ResultMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('result_method')->insert([
            'result_id' => 1,
            'access_modifier' => 'public',
            'non_access_modifier' => 'static',
            'return_type' => 'void',
            'name' => 'printTest',
            'parameter' => '',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'int',
            'name' => 'getNo',
            'parameter' => '',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'void',
            'name' => 'setNo',
            'parameter' => 'int no|',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'int',
            'name' => 'getSpeed',
            'parameter' => '',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'void',
            'name' => 'setSpeed',
            'parameter' => 'int speed|',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'float',
            'name' => 'getWasteTime',
            'parameter' => '',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'void',
            'name' => 'setWasteTime',
            'parameter' => 'float wasteTime|',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'float',
            'name' => 'getToTalTime',
            'parameter' => '',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'void',
            'name' => 'setTotalTime',
            'parameter' => 'float totalTime|',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);

        DB::table('result_method')->insert([
            'result_id' => 3,
            'access_modifier' => 'default',
            'non_access_modifier' => '',
            'return_type' => 'boolean',
            'name' => 'isPrime',
            'parameter' => 'int n|',
            'recursive' => '',
            'loop' => '',
            'score' => 20,
        ]);
    }
}
