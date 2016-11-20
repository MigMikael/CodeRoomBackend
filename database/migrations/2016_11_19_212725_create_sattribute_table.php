<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSattributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_attribute', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('result_id')->unsigned();
            $table->string('access_modifier');
            $table->string('non_access_modifier');
            $table->string('data_type');
            $table->string('name');
            $table->float('score');

            $table->foreign('result_id')
                ->references('id')
                ->on('result')
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
        Schema::drop('result_attribute');
    }
}
