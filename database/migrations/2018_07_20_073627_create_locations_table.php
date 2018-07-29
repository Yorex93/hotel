<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLocationsTable.
 */
class CreateLocationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedInteger('state_id');
			$table->unsignedInteger('country_id');
            $table->decimal('latitude', 4,4)->nullable();
            $table->decimal('longitude', 4,4)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

			$table->foreign('country_id')->references('id')->on('states')->onDelete('CASCADE');
			$table->foreign('state_id')->references('id')->on('states')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations');
	}
}
