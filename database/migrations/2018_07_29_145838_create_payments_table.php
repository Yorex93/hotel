<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePaymentsTable.
 */
class CreatePaymentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('booking_id');
            $table->unsignedInteger('payment_method_id');
            $table->string('payment_ref');
            $table->string('transaction_ref');
            $table->string('payer_full_name');
            $table->string('payer_phone');
            $table->string('payer_email');
            $table->text('narration');
            $table->decimal('total_amount', 18, 2);
            $table->enum('payment_status', ['PENDING', 'SUCCESS', 'FAILED'])->default('PENDING');
            $table->text('payment_status_message')->nullable();
			$table->timestamp('payment_date')->nullable();
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('RESTRICT');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('RESTRICT');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}
}
