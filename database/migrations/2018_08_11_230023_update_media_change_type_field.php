<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMediaChangeTypeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('media', function (Blueprint $table) {
		    $table->dropColumn('type');
		    $table->string('mime_type')->after('title')->nullable();
		    $table->boolean('is_public')->default(true);
		    $table->string('storage_system')->default('LOCAL');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
	        $table->enum('type', ['IMAGE', 'VIDEO', 'FILE'])->nullable();
	        $table->dropColumn('mime_type');
	        $table->dropColumn('is_public');
	        $table->dropColumn('storage_system');
        });
    }
}
