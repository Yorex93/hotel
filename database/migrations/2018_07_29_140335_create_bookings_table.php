<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBookingsTable.
 */
class CreateBookingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->decimal('total_due', 18, 2);
            $table->enum('booking_status', ['PENDING', 'CANCELLED', 'APPROVED'])->default('PENDING');
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('RESTRICT');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookings');
	}
}
