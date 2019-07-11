<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMediaTable.
 */
class CreateMediaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->enum('type', ['IMAGE', 'VIDEO', 'FILE']);
            $table->integer('size')->nullable();
            $table->string('file');
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
		Schema::drop('media');
	}
}
