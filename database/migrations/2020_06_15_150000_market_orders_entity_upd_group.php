<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketOrdersEntityUpdGroup extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders', function(Blueprint $table) {
            $table->boolean('entity_group')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropColumn('entity_group');
        });
    }
}