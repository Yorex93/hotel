<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoomCouponsTable.
 */
class CreateRoomCouponsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('room_coupons', function(Blueprint $table) {
            $table->unsignedInteger('room_id');
            $table->unsignedInteger('coupon_id');

            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('CASCADE');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('room_coupons');
	}
}
