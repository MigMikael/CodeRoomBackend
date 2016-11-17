<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnInProbAnalysis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problem_analysis', function (Blueprint $table) {
            $table->dropColumn('attribute');
            $table->dropColumn('method');
            $table->dropColumn('constructor');
            $table->dropColumn('code');
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
            $table->text('attribute');
            $table->text('method');
            $table->text('constructor');
            $table->text('code');
        });
    }
}
