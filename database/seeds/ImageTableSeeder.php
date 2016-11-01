<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // lesson badge image
        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '244:67:54',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 1',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '244:67:54',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 2',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '244:67:54',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 3',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '244:67:54',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 4',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '244:67:54',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 5',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '244:67:54',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 6',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '0:131:143',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'DS:Lesson 1',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '0:131:143',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'DS:Lesson 2',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '0:131:143',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'DS:Lesson 3',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '0:131:143',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'DS:Lesson 4',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '0:131:143',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'DS:Lesson 5',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '239:108:0',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 1',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '239:108:0',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 2',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '239:108:0',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 3',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '239:108:0',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'CP:Lesson 4',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '63:81:181',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'OO:Lesson 1',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '63:81:181',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'OO:Lesson 2',
            'path' => ''
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '63:81:181',
            'foreground_color' => '255:255:255',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'lesson_badge',
            'text' => 'OO:Lesson 3',
            'path' => ''
        ]);


        // avatar image (teacher)
        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '',
            'foreground_color' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'avatar_image',
            'text' => '',
            'path' => 'http://localhost:8000/api/image/19'
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '',
            'foreground_color' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'avatar_image',
            'text' => '',
            'path' => 'http://localhost:8000/api/image/20'
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '',
            'foreground_color' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'avatar_image',
            'text' => '',
            'path' => 'http://localhost:8000/api/image/21'
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '',
            'foreground_color' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'avatar_image',
            'text' => '',
            'path' => 'http://localhost:8000/api/image/22'
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '',
            'foreground_color' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'avatar_image',
            'text' => '',
            'path' => 'http://localhost:8000/api/image/23'
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '',
            'foreground_color' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'avatar_image',
            'text' => '',
            'path' => 'http://localhost:8000/api/image/24'
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '',
            'foreground_color' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'avatar_image',
            'text' => '',
            'path' => 'http://localhost:8000/api/image/25'
        ]);

        DB::table('image')->insert([
            'height' => 500,
            'width' => 500,
            'background_color' => '',
            'foreground_color' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'type' => 'avatar_image',
            'text' => '',
            'path' => 'http://localhost:8000/api/image/26'
        ]);
    }
}
