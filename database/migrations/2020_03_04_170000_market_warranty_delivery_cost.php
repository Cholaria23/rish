<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketWarrantyDeliveryCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_goods', function(Blueprint $table) {
            $table->integer('warranty')->nullable();
            $table->integer('delivery_cost')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods', function (Blueprint $table) {
            $table->dropColumn('warranty');
            $table->dropColumn('delivery_cost');
        });  
    }
}
