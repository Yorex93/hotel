<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateActivitiesTable.
 */
class CreateActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('slug')->unique();
            $table->integer('max_children');
            $table->integer('max_adults');
            $table->integer('max_people');
            $table->text('description')->nullable();
            $table->decimal('price_per_person', 18, 2)->nullable();
            $table->decimal('latitude', 4, 4)->nullable();
            $table->decimal('longitude', 4, 4)->nullable();
            $table->string('address')->nullable();
            $table->integer('duration')->nullable();
			$table->unsignedInteger('duration_unit_id')->nullable();
			$table->boolean('is_active')->default(true);
            $table->timestamps();

			$table->softDeletes();
            $table->foreign('duration_unit_id')->references('id')
                                               ->on('duration_units')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activities');
	}
}
