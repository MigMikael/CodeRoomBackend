<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission', function (Blueprint $table){
            $table->foreign('student_id')
                ->references('id')
                ->on('student')
                ->onDelete('cascade');

            $table->foreign('problem_id')
                ->references('id')
                ->on('problem')
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
        Schema::table('submission', function (Blueprint $table){
            $table->dropForeign('submission_student_id_foreign');
            $table->dropForeign('submission_problem_id_foreign');
        });
    }
}
