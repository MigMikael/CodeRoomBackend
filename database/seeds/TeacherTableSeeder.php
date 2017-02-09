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
            'email' => 'pinyo@example.com',
            'image' => 19,
            'username' => 'Pinyo',
            'password' => password_hash('Pinyo', PASSWORD_DEFAULT),
            'role' => 'admin',
            'token' => 'WfHp37ebFTHwP12esAPrvJVWkXWLpsDf',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.ดร.สิรักข์ แก้วจำนงค์',
            'email' => 'sirak@example.com',
            'image' => 20,
            'username' => 'Sirak',
            'password' => password_hash('Sirak', PASSWORD_DEFAULT),
            'role' => 'teacher',
            'token' => 'uDhNjRjBOSvpdLsV9vzqfdOibUusKUVw',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.ดร.รัชดาพร คณาวงษ์',
            'email' => 'ratchadaporn@example.com',
            'image' => 21,
            'username' => 'Ratchadaporn',
            'password' => password_hash('Ratchadaporn', PASSWORD_DEFAULT),
            'role' => 'teacher',
            'token' => 'GAT1gY1QUW9FKMAKQnD5sFMY8aE0VZfr',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.เสฐลัทธ์ รอดเหตุภัย',
            'email' => 'sethalat@example.com',
            'image' => 22,
            'username' => 'Sethalat',
            'password' => password_hash('Sethalat', PASSWORD_DEFAULT),
            'role' => 'teacher',
            'token' => 'c8NDwllHQSBnkQKG5SF6aNmxeDYMg7PQ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.ดร.อรวรรณ เชาวลิต',
            'email' => 'orawan@example.com',
            'image' => 23,
            'username' => 'Orawan',
            'password' => password_hash('Orawan', PASSWORD_DEFAULT),
            'role' => 'teacher',
            'token' => 'dN26Dm2s5sJordo8eE6qT3nsnYNRqqWR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teacher')->insert([
            'name' => 'อ.ดร.ทัศนวรรณ ศูนย์กลาง',
            'email' => 'tasanawan@example.com',
            'image' => 24,
            'username' => 'Tasanawan',
            'password' => password_hash('Tasanawan', PASSWORD_DEFAULT),
            'role' => 'teacher',
            'token' => 'tNA3wfIDKk9WmULU6V8WGZ7TcmeHvkSn',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
