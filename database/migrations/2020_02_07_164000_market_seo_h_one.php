<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketSeoHOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->text('h1')->nullable();
        });
        Schema::table('market_goods_lang', function(Blueprint $table) {
            $table->text('h1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->dropColumn('h1');
        });
        Schema::table('market_goods_lang', function(Blueprint $table) {
            $table->dropColumn('h1');
        });      
    }
}