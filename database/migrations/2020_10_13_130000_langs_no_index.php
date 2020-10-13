<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LangsNoIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('languages', function(Blueprint $table) {
            $table->boolean('is_noindex')->default(0);
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('languages', function(Blueprint $table) {
            $table->dropColumn('is_noindex');
        });
    }
}
