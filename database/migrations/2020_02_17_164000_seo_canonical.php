<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeoCanonical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->text('canonical')->nullable();
        });
        Schema::table('units_lang', function(Blueprint $table) {
            $table->text('canonical')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->dropColumn('canonical');
        });
        Schema::table('units_lang', function(Blueprint $table) {
            $table->dropColumn('canonical');
        });      
    }
}