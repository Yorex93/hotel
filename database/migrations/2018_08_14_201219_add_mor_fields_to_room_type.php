<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMorFieldsToRoomType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('room_types', function (Blueprint $table) {
		    $table->text('short_description')->after('description');
		    $table->string('display_image')->after('base_price_per_night')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('room_types', function (Blueprint $table) {
		    $table->dropColumn(['short_description', 'display_image']);
	    });
    }
}
