<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemAnalysisTable extends Migration {

	public function up()
	{
		Schema::create('problem_analysis', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('problem_id')->unsigned();
			$table->string('class', 100);
			$table->string('package', 100);
			$table->string('enclose', 100);
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