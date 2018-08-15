<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->text('description')->after('name')->nullable();
            $table->text('short_description')->after('name')->nullable();
            $table->string('icon')->after('image')->nullable();
            $table->string('slug')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
			$table->dropColumn(['description', 'icon', 'slug', 'short_description']);
        });
    }
}
