<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTestimonialsTable.
 */
class CreateTestimonialsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testimonials', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hotel_id')->nullable();
            $table->string('name');
            $table->string('profession')->nullable();
            $table->text('content');
            $table->string('avatar')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('testimonials');
	}
}
