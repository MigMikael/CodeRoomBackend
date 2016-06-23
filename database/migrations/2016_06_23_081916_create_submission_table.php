<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionTable extends Migration {

	public function up()
	{
		Schema::create('submission', function(Blueprint $table) {
			$table->increments('id');
			$table->string('user_id', 100)->index();
			$table->integer('prob_id')->index();
			$table->integer('sub_num')->default('0');
			$table->datetime('time');
			$table->text('code');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('submission');
	}
}