<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('problemfile', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('problem_id')->unsigned();
            $table->string('package');
			$table->string('filename');
			$table->string('mime');
			$table->text('code');

            $table->foreign('problem_id')
                ->references('id')
                ->on('problem')
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
        Schema::drop('problemfile');
    }
}
