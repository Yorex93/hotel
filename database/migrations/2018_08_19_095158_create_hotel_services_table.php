<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHotelServicesTable.
 */
class CreateHotelServicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotel_services', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->unsignedInteger('parent')->nullable();
            $table->timestamps();

            $table->foreign('parent')->references('id')->on('hotel_services')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hotel_services');
	}
}
