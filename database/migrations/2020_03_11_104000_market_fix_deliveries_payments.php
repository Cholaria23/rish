<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketFixDeliveriesPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

    	Schema::table('market_orders_deliveries_payments', function (Blueprint $table) {
            $table->dropForeign('market_orders_deliveries_payments_1');
            $table->dropForeign('market_orders_deliveries_payments_2');
        });

        Schema::table('market_orders_deliveries_payments', function(Blueprint $table) {
            $table->foreign('delivery_id', 'market_orders_deliveries_payments_1')->references('id')->on('market_orders_deliveries')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('payment_id', 'market_orders_deliveries_payments_2')->references('id')->on('market_orders_payments')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders_deliveries_payments', function (Blueprint $table) {
            $table->dropForeign('market_orders_deliveries_payments_1');
            $table->dropForeign('market_orders_deliveries_payments_2');
        });

         Schema::table('market_orders_deliveries_payments', function(Blueprint $table) {
            $table->foreign('delivery_id', 'market_orders_deliveries_payments_1')->references('id')->on('market_orders_payments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('payment_id', 'market_orders_deliveries_payments_2')->references('id')->on('market_orders_deliveries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }
}