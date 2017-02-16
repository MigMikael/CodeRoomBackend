<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_output', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('submissionfile_id')->unsigned();
            $table->text('content');
            $table->float('score');
            $table->enum('error', ['No Error', 'Time Out', 'Memory Exceed']);

            $table->foreign('submissionfile_id')
                ->references('id')
                ->on('submissionfile')
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
        Schema::drop('submission_output');
    }
}
