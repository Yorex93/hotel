<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHasMediaTable.
 */
class CreateHasMediaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('has_media', function(Blueprint $table) {
			$table->unsignedInteger('media_id');
			$table->unsignedInteger('has_media_id');
			$table->string('has_media_type');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('has_media');
	}
}
