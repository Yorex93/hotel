<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHasFacilitiesTable.
 */
class CreateHasFacilitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('has_facilities', function(Blueprint $table) {

			$table->unsignedInteger('facility_id');
			$table->unsignedInteger('has_facility_id');
			$table->string('has_facility_type');
			$table->foreign('facility_id')->references('id')->on('facilities')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('has_facilities');
	}
}
