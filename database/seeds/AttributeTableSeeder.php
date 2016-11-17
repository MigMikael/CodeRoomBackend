<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attribute')->insert([
            'analysis_id' => 1,
            'access_modifier' => 'default',
            'non_access_modifier' => 'static',
            'data_type' => 'int',
            'name' => 'round',
            'score' => 10,
        ]);

        DB::table('attribute')->insert([
            'analysis_id' => 1,
            'access_modifier' => 'default',
            'non_access_modifier' => 'static',
            'data_type' => 'float',
            'name' => 'time',
            'score' => 10,
        ]);

        DB::table('attribute')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'default',
            'non_access_modifier' => '',
            'data_type' => 'int',
            'name' => 'no',
            'score' => 10,
        ]);

        DB::table('attribute')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'default',
            'non_access_modifier' => '',
            'data_type' => 'int',
            'name' => 'speed',
            'score' => 10,
        ]);

        DB::table('attribute')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'default',
            'non_access_modifier' => '',
            'data_type' => 'float',
            'name' => 'wasteTime',
            'score' => 10,
        ]);

        DB::table('attribute')->insert([
            'analysis_id' => 2,
            'access_modifier' => 'default',
            'non_access_modifier' => '',
            'data_type' => 'float',
            'name' => 'totalTime',
            'score' => 10,
        ]);
    }
}
