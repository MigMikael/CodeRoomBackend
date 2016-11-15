<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollumCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Todo Remove this column
        Schema::table('problem_analysis', function (Blueprint $table) {
            //
            $table->addColumn('text','code');
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
            //
            $table->dropColumn('code');
        });
    }
}
