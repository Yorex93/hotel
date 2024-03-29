<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoomServicesTable.
 */
class CreateRoomServicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('room_services', function(Blueprint $table) {
            $table->unsignedInteger('room_type_id');
            $table->unsignedInteger('service_id');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('CASCADE');
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
		Schema::drop('room_services');
	}
}
