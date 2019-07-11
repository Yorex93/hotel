<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHotelSocialsTable.
 */
class CreateHotelSocialsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotel_socials', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('social_id');
            $table->string('social_link');
            $table->timestamps();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('CASCADE');
            $table->foreign('social_id')->references('id')->on('socials')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hotel_socials');
	}
}
