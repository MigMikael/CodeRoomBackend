<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultTable extends Migration {

	public function up()
	{
		Schema::create('result', function(Blueprint $table) {
		    $table->increments('id');
			$table->integer('submission_id')->unsigned();
			$table->string('class');
			$table->string('package');
			$table->string('enclose');
			$table->text('attribute');
			$table->text('method');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('result');
	}
}