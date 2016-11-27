<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('result', function (Blueprint $table){
            $table->foreign('submissionfile_id')
                ->references('id')
                ->on('submissionfile')
                ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('result', function (Blueprint $table){
            $table->dropForeign('result_submissionfile_id_foreign');
        });*/
    }
}
