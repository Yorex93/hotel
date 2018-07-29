<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHotelActivitiesTable.
 */
class CreateHotelActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotel_activities', function(Blueprint $table) {
			$table->unsignedInteger('hotel_id');
			$table->unsignedInteger('activity_id');

			$table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('CASCADE');
			$table->foreign('activity_id')->references('id')->on('activities')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hotel_activities');
	}
}
