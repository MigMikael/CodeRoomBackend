<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnInResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('result', function (Blueprint $table) {
            $table->dropColumn('attribute');
            $table->dropColumn('method');
            $table->dropColumn('constructor');
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
            $table->text('attribute');
            $table->text('method');
            $table->text('constructor');
        });
    }
}
