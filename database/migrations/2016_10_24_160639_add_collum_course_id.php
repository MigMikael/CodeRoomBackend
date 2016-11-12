<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumCourseId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('badge', function (Blueprint $table){
            $table->integer('course_id')->unsigned();

            $table->foreign('course_id')
                ->references('id')
                ->on('course')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('badge', function (Blueprint $table){
            $table->dropForeign('badge_course_id_foreign');
            $table->dropColumn('course_id');
        });
    }
}
