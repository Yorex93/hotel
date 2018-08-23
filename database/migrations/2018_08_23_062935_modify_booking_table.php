<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
	        $table->string('title')->after('user_id')->nullable();
	        $table->string('first_name')->after('title')->nullable();
	        $table->string('last_name')->after('first_name')->nullable();
	        $table->string('phone')->after('last_name')->nullable();
	        $table->string('email')->after('phone')->nullable();
	        $table->string('address')->after('email')->nullable();
	        $table->text('special_requirement')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['title', 'first_name', 'last_name', 'phone', 'email', 'address', 'special_requirement']);
        });
    }
}
