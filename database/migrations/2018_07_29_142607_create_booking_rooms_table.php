<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBookingRoomsTable.
 */
class CreateBookingRoomsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking_rooms', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('booking_id');
			$table->unsignedInteger('room_type_id')->nullable();
			$table->unsignedInteger('room_id')->nullable();
			$table->date('check_in');
			$table->date('check_out');
			$table->integer('adults');
			$table->integer('children')->default(0);
			$table->decimal('amount', 18, 2);
			$table->unsignedInteger('coupon_id')->nullable();
			$table->decimal('discount', 18, 2)->default(0);
			$table->decimal('tax', 18,2)->default(0);
			$table->decimal('total', 18,2);
			$table->timestamps();
			$table->foreign('booking_id')->references('id')->on('bookings')->onDelete('RESTRICT');
			$table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('SET NULL');
			$table->foreign('room_id')->references('id')->on('rooms')->onDelete('SET NULL');
			$table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('booking_rooms');
	}
}
