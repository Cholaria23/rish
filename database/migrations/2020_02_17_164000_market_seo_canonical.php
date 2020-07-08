<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketSeoCanonical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->text('canonical')->nullable();
        });
        Schema::table('market_goods_lang', function(Blueprint $table) {
            $table->text('canonical')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->dropColumn('canonical');
        });
        Schema::table('market_goods_lang', function(Blueprint $table) {
            $table->dropColumn('canonical');
        });      
    }
}