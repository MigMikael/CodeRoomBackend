<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToTeacherCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_course', function (Blueprint $table){
            $table->foreign('teacher_id')->references('id')->on('teacher')->onDelete('cascade');;
            $table->foreign('course_id')->references('id')->on('course')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_course', function (Blueprint $table){
            $table->dropForeign('teacher_course_teacher_id_foreign');
            $table->dropForeign('teacher_course_course_id_foreign');
        });
    }
}
