<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teacher')->insert([
            'name' => 'อ.ดร.ภิญโญ แท้ประสาทสิทธิ์',
            'image' => 19,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.ดร.สิรักข์ แก้วจำนงค์',
            'image' => 20,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.ดร.รัชดาพร คณาวงษ์',
            'image' => 21,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.เสฐลัทธ์ รอดเหตุภัย',
            'image' => 22,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.ดร.อรวรรณ เชาวลิต',
            'image' => 23,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.ดร.ทัศนวรรณ ศูนย์กลาง',
            'image' => 24,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
