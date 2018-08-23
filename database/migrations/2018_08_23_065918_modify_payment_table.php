<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id'])->change();
            $table->dropColumn('payment_method_id');
            $table->string('payment_method')->after('booking_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedInteger('payment_method_id')->after('booking_id');
            $table->dropColumn('payment_method');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('SET NULL');
        });
    }
}
