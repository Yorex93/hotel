<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateServicesTable.
 */
class CreateServicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('description');
			$table->text('long_description')->nullable();
			$table->unsignedInteger('price_type_id');
			$table->decimal('base_price', 18, 2)->nullable();
			$table->decimal('included_tax', 18, 2)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('price_type_id')->references('id')->on('price_types')->onDelete('RESTRICT');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('services');
	}
}
