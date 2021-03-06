<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToProblemAnalysis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problem_analysis', function (Blueprint $table){
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
        Schema::table('problem_analysis', function (Blueprint $table){
            $table->dropForeign('problem_analysis_problemfile_id_foreign');
        });
    }
}
