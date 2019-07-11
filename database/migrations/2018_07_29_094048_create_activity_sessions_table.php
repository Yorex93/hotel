<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateActivitySessionsTable.
 */
class CreateActivitySessionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_sessions', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id');
            $table->unsignedInteger('hotel_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('days')->nullable();
            $table->decimal('price_per_adult', 18, 2)->nullable();
            $table->decimal('price_per_child', 18, 2)->nullable();
            $table->decimal('discount', 18, 2)->nullable();
            $table->enum('discount_type', ['FIXED', 'PERCENTAGE'])->nullable();
            $table->decimal('included_vat', 18, 2)->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
			$table->softDeletes();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('CASCADE');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_sessions');
	}
}
