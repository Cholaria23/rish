<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketCatGoodsCount extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories', function(Blueprint $table) {
            $table->integer('view_pages_count')->default(20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('view_pages_count');
        });
    }
}