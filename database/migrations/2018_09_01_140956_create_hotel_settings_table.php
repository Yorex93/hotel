<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHotelSettingsTable.
 */
class CreateHotelSettingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotel_settings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('reservation_email');
            $table->string('reservation_mobile')->nullable();
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
		Schema::drop('hotel_settings');
	}
}
