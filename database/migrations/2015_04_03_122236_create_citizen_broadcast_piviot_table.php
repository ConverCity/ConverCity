<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenBroadcastPiviotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('broadcast_citizen', function(Blueprint $table)
		{
			$table->integer('broadcast_id')->unsigned();
			$table->foreign('broadcast_id')->references('id')->on('broadcasts')->onDelete('cascade');
			$table->integer('citizen_id')->unsigned();
			$table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('broadcast_citizen');
	}

}
