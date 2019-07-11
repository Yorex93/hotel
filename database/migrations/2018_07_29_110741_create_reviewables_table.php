<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReviewablesTable.
 */
class CreateReviewablesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviewables', function(Blueprint $table) {
            $table->unsignedInteger('review_id');
            $table->unsignedInteger('reviewable_id');
            $table->string('reviewable_type');

            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reviewables');
	}
}
