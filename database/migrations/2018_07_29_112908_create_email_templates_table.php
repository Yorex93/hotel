<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmailTemplatesTable.
 */
class CreateEmailTemplatesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_templates', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('subject');
            $table->longText('content');
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
		Schema::drop('email_templates');
	}
}
