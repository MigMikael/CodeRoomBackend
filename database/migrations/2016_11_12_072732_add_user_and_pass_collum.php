<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserAndPassCollum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher', function (Blueprint $table){
            $table->string('username')->unique();
            $table->string('password');
        });

        Schema::table('student', function (Blueprint $table){
            $table->string('username')->unique();
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student', function (Blueprint $table){
            $table->dropColumn('username');
            $table->dropColumn('password');
        });

        Schema::table('teacher', function (Blueprint $table){
            $table->dropColumn('username');
            $table->dropColumn('password');
        });
    }
}
