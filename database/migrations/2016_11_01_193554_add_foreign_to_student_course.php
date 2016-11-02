<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToStudentCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_course', function (Blueprint $table){
            $table->foreign('student_id')->references('id')->on('student');
            $table->foreign('course_id')->references('id')->on('course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_course', function (Blueprint $table){
            $table->dropForeign('student_course_student_id_foreign');
            $table->dropForeign('student_course_course_id_foreign');
        });
    }
}
