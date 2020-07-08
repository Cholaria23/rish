<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SectionsInMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sections', function(Blueprint $table) {
            $table->boolean('is_in_menu')->default(1);
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('sections', function(Blueprint $table) {
            $table->dropColumn('is_in_menu');
        });
    }
}