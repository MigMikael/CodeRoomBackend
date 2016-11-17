<?php

use Illuminate\Database\Seeder;

class MethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('method')->insert([
            'analysis_id' => 1,
            'access_modifier' => 'public',
            'non_access_modifier' => 'static',
            'return_type' => 'void',
            'name' => 'printTest',
            'parameter' => '',
            'score' => 20,
        ]);

        DB::table('method')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'int',
            'name' => 'getNo',
            'parameter' => '',
            'score' => 20,
        ]);

        DB::table('method')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'void',
            'name' => 'setNo',
            'parameter' => 'int no|',
            'score' => 20,
        ]);

        DB::table('method')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'int',
            'name' => 'getSpeed',
            'parameter' => '',
            'score' => 20,
        ]);

        DB::table('method')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'void',
            'name' => 'setSpeed',
            'parameter' => 'int speed|',
            'score' => 20,
        ]);

        DB::table('method')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'float',
            'name' => 'getWasteTime',
            'parameter' => '',
            'score' => 20,
        ]);

        DB::table('method')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'void',
            'name' => 'setWasteTime',
            'parameter' => 'float wasteTime|',
            'score' => 20,
        ]);

        DB::table('method')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'float',
            'name' => 'getToTalTime',
            'parameter' => '',
            'score' => 20,
        ]);

        DB::table('method')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'public',
            'non_access_modifier' => '',
            'return_type' => 'void',
            'name' => 'setTotalTime',
            'parameter' => 'float totalTime|',
            'score' => 20,
        ]);
    }
}
