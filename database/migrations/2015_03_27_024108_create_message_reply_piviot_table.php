<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageReplyPiviotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message_reply', function(Blueprint $table)
		{
			$table->integer('message_id')->unsigned();
			$table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
			$table->integer('reply_id')->unsigned();
			$table->foreign('reply_id')->references('id')->on('replies')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('message_reply');
	}

}
