<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumConstructor2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('result', function (Blueprint $table) {
            $table->text('constructor');
        });

        Schema::table('result_structure_score', function (Blueprint $table) {
            $table->text('constructor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('result', function (Blueprint $table) {
            $table->dropColumn('constructor');
        });

        Schema::table('result_structure_score', function (Blueprint $table) {
            $table->dropColumn('constructor');
        });
    }
}
