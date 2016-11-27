<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemAnalysisTable extends Migration {

	public function up()
	{
		Schema::create('problem_analysis', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('problemfile_id')->unsigned();
			$table->string('class');
			$table->string('package');
			$table->string('enclose');
            $table->string('extends');
            $table->string('implements');
			$table->text('attribute');
			$table->text('method');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('problem_analysis');
	}
}