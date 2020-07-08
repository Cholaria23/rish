<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsAddMetaTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
		Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->string('add_meta_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->dropColumn('add_meta_title');
        });    
    }
}
