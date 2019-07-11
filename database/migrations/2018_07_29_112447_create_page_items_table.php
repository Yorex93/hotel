<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePageItemsTable.
 */
class CreatePageItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('page_items', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->string('heading');
            $table->string('content')->nullable();
            $table->timestamps();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('page_items');
	}
}
