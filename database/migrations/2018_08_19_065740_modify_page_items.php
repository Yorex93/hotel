<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPageItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_items', function (Blueprint $table) {
            $table->string('heading')->nullable()->change();
            $table->string('image')->after('content')->nullable();
            $table->string('file')->after('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_items', function (Blueprint $table) {
            $table->string('heading')->nullable(false)->change();
            $table->dropColumn('image');
            $table->dropColumn('file');
        });
    }
}
