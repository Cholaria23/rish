<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeoHOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->text('h1')->nullable();
        });
        Schema::table('units_lang', function(Blueprint $table) {
            $table->text('h1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->dropColumn('h1');
        });
        Schema::table('units_lang', function(Blueprint $table) {
            $table->dropColumn('h1');
        });      
    }
}