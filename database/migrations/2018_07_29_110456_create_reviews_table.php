<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReviewsTable.
 */
class CreateReviewsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
            $table->increments('id');
            $table->string('reviewer');
            $table->string('reviewer_phone')->nullable();
            $table->string('reviewer_email')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedInteger('rating');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reviews');
	}
}
