<?php

use Illuminate\Database\Seeder;

class ResultConstructorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('result_constructor')->insert([
            'result_id' => 3,
            'access_modifier' => 'public',
            'name' => 'PrimeNumberFinder',
            'parameter' => '',
            'score' => 10,
        ]);
    }
}
