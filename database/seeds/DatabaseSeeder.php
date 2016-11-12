<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(LessonTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(StudentCourseTableSeeder::class);
        $this->call(StudentLessonTableSeeder::class);

        $this->call(TeacherTableSeeder::class);
        $this->call(TeacherCourseTableSeeder::class);

        $this->call(BadgeTableSeeder::class);
        $this->call(BadgeStudentSeeder::class);
        $this->call(AnnouncementTableSeeder::class);
    }
}
