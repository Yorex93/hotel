<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHotelsTable.
 */
class CreateHotelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotels', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sub_title')->nullable();
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->unsignedInteger('parent_hotel_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();
			$table->boolean('is_active')->default(true);
            $table->timestamps();
			$table->softDeletes();
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('SET NULL');
			$table->foreign('parent_hotel_id')->nullable()->references('id')->on('hotels')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hotels');
	}
}
