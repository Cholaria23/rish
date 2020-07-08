<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketOrdersEntityUpd extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders', function(Blueprint $table) {
            $table->boolean('entity_is_nds')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropColumn('entity_is_nds');
        });
    }
}