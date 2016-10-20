<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->insert([
            'name' => 'Computer Programming I',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','c.png'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('course')->insert([
            'name' => 'Computer Programming II',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','java.png'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('course')->insert([
            'name' => 'Data Structures',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','datastruct.png'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('course')->insert([
            'name' => 'Object Oriented Software Development',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','oosd.png'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
