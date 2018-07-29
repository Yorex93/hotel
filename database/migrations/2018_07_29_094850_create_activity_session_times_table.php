<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateActivitySessionTimesTable.
 */
class CreateActivitySessionTimesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_session_times', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_session_id');
            $table->time('start_time');
            $table->time('finish_time');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
			$table->softDeletes();
            $table->foreign('activity_session_id')->references('id')->on('activity_sessions')
	            ->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_session_times');
	}
}
