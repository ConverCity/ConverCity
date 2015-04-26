<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatamarkersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datamarkers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('message_id')->unsigned();
			$table->foreign('message_id')->references('id')->on('messages');
			$table->integer('reply_id')->unsigned();
			$table->foreign('reply_id')->references('id')->on('replies');
			$table->integer('field_id')->unsigned();
			$table->foreign('field_id')->references('id')->on('fields');
			$table->string('value');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('datamarkers');
	}

}
