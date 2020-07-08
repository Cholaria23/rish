<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WebpParams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('params', function(Blueprint $table) {
            $table->boolean('is_webp')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('params', function (Blueprint $table) {
            $table->dropColumn('is_webp');
        });    
    }
}