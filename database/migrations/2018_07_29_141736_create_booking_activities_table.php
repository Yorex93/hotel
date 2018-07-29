<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBookingActivitiesTable.
 */
class CreateBookingActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking_activities', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('booking_id');
            $table->unsignedInteger('activity_id')->nullable();
            $table->unsignedInteger('activity_session_time_id')->nullable();
            $table->date('activity_date');
            $table->integer('adults');
            $table->integer('children')->default(0);
            $table->decimal('amount', 18, 2);
            $table->decimal('tax', 18, 2)->default(0);
            $table->decimal('discount', 18, 2)->default(0);
            $table->decimal('total', 18, 2);
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('RESTRICT');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('SET NULL');
            $table->foreign('activity_session_time_id')->references('id')->on('activity_session_times')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('booking_activities');
	}
}
