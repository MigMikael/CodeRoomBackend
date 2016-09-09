<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultStructureScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_structure_score', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('class')->default(0);
            $table->integer('package')->default(0);
            $table->integer('enclose')->default(0);
            $table->text('attribute');
            $table->text('method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('result_structure_score');
    }
}
