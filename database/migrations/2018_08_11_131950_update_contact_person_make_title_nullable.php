<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContactPersonMakeTitleNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('contact_people', function(Blueprint $table) {
	    	$table->string('title')->nullable()->change();
	    	$table->string('middle_name')->nullable()->change();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('contact_people', function(Blueprint $table) {
		    $table->string('title')->nullable(false)->change();
		    $table->string('middle_name')->nullable(false)->change();
	    });
    }
}
