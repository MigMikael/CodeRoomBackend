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
        $generator = new \App\Helper\TokenGenerate();
        DB::table('course')->insert([
            'name' => 'Computer Programming I',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','c.png'),
            'token' => $generator->generate(6),
            'color' => '244:67:54',
            'status' => 'enable',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('course')->insert([
            'name' => 'Computer Programming II',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','java.png'),
            'token' => $generator->generate(6),
            'color' => '239:108:0',
            'status' => 'enable',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('course')->insert([
            'name' => 'Data Structures',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','datastruct.png'),
            'token' => $generator->generate(6),
            'color' => '0:131:143',
            'status' => 'enable',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('course')->insert([
            'name' => 'Object Oriented Software Development',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','oosd.png'),
            'token' => $generator->generate(6),
            'color' => '63:81:181',
            'status' => 'enable',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('course')->insert([
            'name' => 'Research Method',
            'image' => 'http://localhost:8000/api/course/image/'. str_replace('.','_','rm.png'),
            'token' => $generator->generate(6),
            'color' => '0:105:92',
            'status' => 'disable',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
