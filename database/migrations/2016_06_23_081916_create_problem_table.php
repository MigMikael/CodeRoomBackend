<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemTable extends Migration {

	public function up()
	{
		Schema::create('problem', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('lesson_id')->unsigned();
			$table->string('name', 100);
			$table->string('description', 100);
			$table->string('evaluator', 100);
			$table->float('timelimit')->default('1');
			$table->float('memorylimit')->default('32');
            $table->string('is_parse')->default('false');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('problem');
	}
}