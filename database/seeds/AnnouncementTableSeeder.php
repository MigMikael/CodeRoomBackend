<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnnouncementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Computer Programming I
        DB::table('announcement')->insert([
            'course_id' => 1,
            'title' => 'ประกาศผลสอบ Mid Term',
            'content' => 'ผลสอบออกแล้วนะครับ ใครรุ่งใครร่วงเข้าไปดูกันได้ในลิงค์เลยครับ <a href="http://www.w3schools.com">คลิก</a>',
            'priority' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('announcement')->insert([
            'course_id' => 1,
            'title' => 'ผู้ใดลืมความรู้ไว้ในห้องแล็ป',
            'content' => 'วันนี้พี่คุมแล็ปเดินเช็คความเรียบร้อยก่อนปิดห้องแล็ป พบความรู้หล่นกระจายอยู่ทั้วทั้งห้อง เป็นของผู้ใดให้มารับได้ที่คุณสานนท์',
            'priority' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('announcement')->insert([
            'course_id' => 1,
            'title' => 'แจ้งเตือนสอบไฟนอล',
            'content' => 'ใกล้สอบแล้ว อย่ามัวแต่จับโปเกม่อน เริ่มอ่านหนังสือกันได้แล้ว',
            'priority' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        //Computer Programming II
        DB::table('announcement')->insert([
            'course_id' => 2,
            'title' => 'ประกาศผลสอบ Mid Term',
            'content' => 'ผลสอบออกแล้วนะครับ ตกกันเยอะมาก 90% เลยทีเดียว <a href="http://www.w3schools.com">คลิก</a>',
            'priority' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('announcement')->insert([
            'course_id' => 2,
            'title' => 'หนังสือแนะนำสำหรับอ่านเพิ่มเติม',
            'content' => 'หนังสือพวกนี้เป็นหนังสือที่พวกคุณควรอ่าน เพิ่มเติมเพือให้เข้าใจเนื้อหามากขึ้น <a href="http://www.w3schools.com">ภาษาจาวาที่ละหลายหลายก้าว</a> <a href="http://www.w3schools.com">Big Java</a> <a href="http://www.w3schools.com">วาจาจาวา</a>',
            'priority' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        //OOSD
        DB::table('announcement')->insert([
            'course_id' => 4,
            'title' => 'ประกาศวันสอบ',
            'content' => 'อาจารย์ได้เลื่อนวันสอบมิดเทอมไปเป็นวันที่ 30 กุมภา ตามที่นักศึกษาขอมาแล้ว นักศึกษาสามารถลงทะเบียนใน Reg ได้',
            'priority' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
