<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveResultStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('result_structure_score');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('result_structure_score', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('analysis_id')->unsigned();
            $table->integer('class')->default(0);
            $table->integer('package')->default(0);
            $table->integer('enclose')->default(0);
            $table->text('attribute');
            $table->text('method');
            $table->timestamps();

            $table->foreign('analysis_id')
                ->references('id')
                ->on('problem_analysis')
                ->onDelete('cascade');
        });
    }
}
