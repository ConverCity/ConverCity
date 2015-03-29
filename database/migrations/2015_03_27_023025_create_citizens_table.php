<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('citizens', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('phone_number')->unique();
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
		Schema::drop('citizens');
	}

}
