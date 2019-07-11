<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoomTypesTable.
 */
class CreateRoomTypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('room_types', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('hotel_id');
			$table->string('title');
			$table->string('sub_title')->nullable();
			$table->string('slug')->unique();
			$table->integer('max_children');
			$table->integer('max_adults');
			$table->integer('max_people');
			$table->longText('description')->nullable();
			$table->decimal('base_price_per_night', 18,2)->nullable();
			$table->timestamp('maintenance_start')->nullable();
			$table->timestamp('maintenance_end')->nullable();
			$table->boolean('is_active')->default(true);
			$table->boolean('is_homepage')->default(true);
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('room_types');
	}
}
