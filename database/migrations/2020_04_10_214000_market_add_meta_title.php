<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketAddMetaTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
		Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->string('add_meta_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->dropColumn('add_meta_title');
        });    
    }
}
