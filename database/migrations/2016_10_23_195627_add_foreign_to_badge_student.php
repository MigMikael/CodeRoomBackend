<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToBadgeStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('badge_student', function (Blueprint $table){
            $table->foreign('student_id')->references('id')->on('student');
            $table->foreign('badge_id')->references('id')->on('badge');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('badge_student', function (Blueprint $table){
            $table->dropForeign('badge_student_student_id_foreign');
            $table->dropForeign('badge_student_badge_id_foreign');
        });
    }
}
