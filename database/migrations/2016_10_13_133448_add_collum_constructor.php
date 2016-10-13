<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumConstructor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problem_analysis', function (Blueprint $table) {
            $table->string('constructor');
        });

        Schema::table('problem_structure_score', function (Blueprint $table) {
            $table->string('constructor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('problem_analysis', function (Blueprint $table) {
            $table->dropColumn('constructor');
        });

        Schema::table('problem_structure_score', function (Blueprint $table) {
            $table->dropColumn('constructor');
        });
    }
}
