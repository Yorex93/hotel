<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBookingServicesTable.
 */
class CreateBookingServicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking_services', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('booking_room_id');
            $table->unsignedInteger('service_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 18, 2);
            $table->decimal('tax', 18, 2);
            $table->decimal('total_amount', 18, 2);
            $table->timestamps();
            $table->foreign('booking_room_id')->references('id')->on('booking_rooms')->onDelete('CASCADE');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('booking_services');
	}
}
