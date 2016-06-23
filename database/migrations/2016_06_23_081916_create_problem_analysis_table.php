<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemAnalysisTable extends Migration {

	public function up()
	{
		Schema::create('problem_analysis', function(Blueprint $table) {
			$table->integer('prob_id')->index();
			$table->string('class', 100);
			$table->string('package', 100);
			$table->string('enclose', 100);
			$table->text('attribute');
			$table->string('attribute_score', 500);
			$table->text('method');
			$table->string('method_score', 500);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('problem_analysis');
	}
}