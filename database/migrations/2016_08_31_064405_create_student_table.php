<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('student_id');
            $table->string('name');
            $table->string('email');
            $table->integer('image')->unsigned();
            $table->string('token')->unique();
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
        Schema::drop('student');
    }
}
