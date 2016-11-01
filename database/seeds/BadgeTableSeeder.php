<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Computer Programming I
        DB::table('badge')->insert([
            'name' => 'บทนำเกี่ยวกับคอมพิวเตอร์และการโปรแกรม',
            'description' => 'Correct all Problem In บทนำเกี่ยวกับคอมพิวเตอร์และการโปรแกรม',
            'image' => 1,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'Quiz บทนำเกี่ยวกับคอมพิวเตอร์และการโปรแกรม',
            'description' => 'Correct all Problem In Quiz บทนำเกี่ยวกับคอมพิวเตอร์และการโปรแกรม',
            'image' => 2,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'การวิเคราะห์และแก้ปัญหา',
            'description' => 'Correct all Problem In การวิเคราะห์และแก้ปัญหา',
            'image' => 3,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'โครงสร้างภาษาซี ตัวแปร และ การแสดงผลอย่างง่าย',
            'description' => 'Correct all Problem In โครงสร้างภาษาซี ตัวแปร และ การแสดงผลอย่างง่าย',
            'image' => 4,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'Quiz โครงสร้างภาษาซี ตัวแปร และ การแสดงผลอย่างง่าย',
            'description' => 'Correct all Problem In Quiz โครงสร้างภาษาซี ตัวแปร และ การแสดงผลอย่างง่าย',
            'image' => 5,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'ตัวดำเนินการ (operators), การรับข้อมูลเข้า และ การแสดงผลลัพธ์',
            'description' => 'Correct all Problem In Quiz ตัวดำเนินการ (operators), การรับข้อมูลเข้า และ การแสดงผลลัพธ์',
            'image' => 6,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        // Data Structures
        DB::table('badge')->insert([
            'name' => 'Array',
            'description' => 'Correct all Problem In Array',
            'image' => 7,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'Quiz Array',
            'description' => 'Correct all Problem In Quiz Array',
            'image' => 8,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'Link List',
            'description' => 'Correct all Problem In Link List',
            'image' => 9,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'Tree',
            'description' => 'Correct all Problem In Tree',
            'image' => 10,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'Graph',
            'description' => 'Correct all Problem In Tree',
            'image' => 11,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        // Computer Programming II
        DB::table('badge')->insert([
            'name' => 'แนะนํารายวิชาและรู้จัก Java',
            'description' => 'Correct all Problem In แนะนํารายวิชาและรู้จัก Java',
            'image' => 12,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'ความรู้พื้นฐาน ตัวแปร ชนิดข้อมูล',
            'description' => 'Correct all Problem In ความรู้พื้นฐาน ตัวแปร ชนิดข้อมูล',
            'image' => 13,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'ตัวแปร ชนิดข้อมูล และการดําเนินการ',
            'description' => 'Correct all Problem In ตัวแปร ชนิดข้อมูล และการดําเนินการ',
            'image' => 14,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'คําสั่งเดี่ยว คําสั่งเงื่อนไข และชุดคําสั่ง',
            'description' => 'Correct all Problem In คําสั่งเดี่ยว คําสั่งเงื่อนไข และชุดคําสั่ง',
            'image' => 15,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        // OOSD
        DB::table('badge')->insert([
            'name' => 'Quiz Lab 1',
            'description' => 'Correct all Problem In Quiz Lab 1',
            'image' => 16,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'Quiz Lab 2',
            'description' => 'Correct all Problem In Quiz Lab 2',
            'image' => 17,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('badge')->insert([
            'name' => 'Quiz Lab 3',
            'description' => 'Correct all Problem In Quiz Lab 3',
            'image' => 18,
            'type' => 'lesson_badge',
            'criteria' => 0,
            'course_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
