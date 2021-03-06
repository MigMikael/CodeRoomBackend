<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_output', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('problemfile_id')->unsigned();
            $table->integer('version');
            $table->string('filename');
            $table->text('content');
            $table->float('score');

            $table->foreign('problemfile_id')
                ->references('id')
                ->on('problemfile')
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
        Schema::drop('problem_output');
    }
}
