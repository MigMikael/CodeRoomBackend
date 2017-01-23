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
            'password' => password_hash('mig39525G', PASSWORD_DEFAULT),
            'token' => '2t2bTG6KsgNuvTIY8oSvYWtRLrXC4P6R',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student')->insert([
            'student_id' => '07560445',
            'name' => 'นันทิพัฒน์ พลบดี',
            'image' => 26,
            'username' => 'Manny',
            'password' => password_hash('Manny', PASSWORD_DEFAULT),
            'token' => 'k1bNN5piKWmzVAWBwXFP8Hs2Qc0JTtb6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('student')->insert([
            'student_id' => '07570497',
            'name' => 'ธนเดช พัดทอง',
            'image' => 27,
            'username' => 'Au',
            'password' => password_hash('Au', PASSWORD_DEFAULT),
            'token' => 'eDAs36X1d3TDH8tZVdchphucYusqZq9S',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
