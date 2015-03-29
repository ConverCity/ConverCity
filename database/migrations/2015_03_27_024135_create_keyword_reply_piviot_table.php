<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordReplyPiviotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keyword_reply', function(Blueprint $table)
		{
			$table->integer('keyword_id');
			$table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade');
			$table->integer('reply_id');
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
		Schema::drop('keyword_reply');
	}

}
