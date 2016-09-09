<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemTable extends Migration {

	public function up()
	{
		Schema::create('problem', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->string('description', 100);
			$table->string('type', 30);
			$table->integer('prob_order');
			$table->string('color', 7);
			$table->string('tag', 500);
			$table->integer('total');
			$table->string('evaluator', 100);
			$table->string('time', 50);
			$table->float('timelimit')->default('1');
			$table->float('memorylimit')->default('32');
			$table->string('prerequiresite', 500);
			$table->boolean('avail')->default(false);
			$table->string('ready', 10)->default('unready');
			$table->text('code');
			$table->string('token', 21)->default('1/1');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('problem');
	}
}