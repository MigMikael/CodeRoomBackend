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

        $this->call(ProblemTableSeeder::class);
        $this->call(ProblemFileTableSeeder::class);
        $this->call(ProblemAnalysisTableSeeder::class);
        $this->call(ProblemScoreTableSeeder::class);
        $this->call(AttributeTableSeeder::class);
        $this->call(ConstructorTableSeeder::class);
        $this->call(MethodTableSeeder::class);
        $this->call(ProblemInputTableSeeder::class);
        $this->call(ProblemOutputTableSeeder::class);

        $this->call(SubmissionTableSeeder::class);
        $this->call(SubmissionFileTableSeeder::class);

        $this->call(ResultTableSeeder::class);

    }
}
