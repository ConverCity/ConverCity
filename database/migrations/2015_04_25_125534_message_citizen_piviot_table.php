<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessageCitizenPiviotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('citizen_message', function(Blueprint $table)
		{
			$table->integer('citizen_id')->unsigned();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->integer('message_id')->unsigned();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('citizen_message');
	}

}
