<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketPricePartner extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_price_types', function (Blueprint $table) {            
            $table->boolean('is_partner')->default(0); 
        });
        Schema::table('market_orders_goods', function (Blueprint $table) {            
            $table->float('partner_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_price_types', function (Blueprint $table) {
            $table->dropColumn('is_partner');
        });
        Schema::table('market_orders_goods', function (Blueprint $table) {
            $table->dropColumn('partner_price');
        });
    }
}
