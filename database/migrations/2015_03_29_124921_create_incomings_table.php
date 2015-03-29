<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incomings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('message');
			$table->text('meta');
			$table->integer('citizen_id')->unsigned();
			$table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
			$table->integer('message_id')->unsigned();
			$table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
			$table->integer('reply_id')->unsigned();
			$table->foreign('reply_id')->references('id')->on('replies')->onDelete('cascade');
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
		Schema::drop('incomings');
	}

}
