<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultTable extends Migration {

	public function up()
	{
		Schema::create('result', function(Blueprint $table) {
			$table->integer('submission_id')->index();
			$table->string('class', 100)->nullable()->index();
			$table->string('package', 100)->nullable();
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
		Schema::drop('result');
	}
}