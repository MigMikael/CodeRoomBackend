<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->insert([
            'student_id' => '07560550',
            'name' => 'Chanachai Puttaruksa',
            'image' => 25,
            'username' => 'MigMikael',
            'password' => bcrypt('mig39525G'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student')->insert([
            'student_id' => '07560445',
            'name' => 'นันทิพัฒน์ พลบดี',
            'image' => 26,
            'username' => 'Manny',
            'password' => bcrypt('manny'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student')->insert([
            'student_id' => '07570497',
            'name' => 'ธนเดช พัดทอง',
            'image' => 27,
            'username' => 'Au',
            'password' => bcrypt('au'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
