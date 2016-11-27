<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionTable extends Migration {

	public function up()
	{
		Schema::create('submission', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('student_id')->unsigned();
			$table->integer('problem_id')->unsigned();
			$table->integer('sub_num')->default('0');
            $table->string('is_accept')->default('false');
			$table->datetime('time');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('submission');
	}
}