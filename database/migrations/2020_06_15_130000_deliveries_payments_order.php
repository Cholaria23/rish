<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeliveriesPaymentsOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders_deliveries', function(Blueprint $table) {
            $table->integer('sort_order')->default(0);
        });
        Schema::table('market_orders_payments', function(Blueprint $table) {
            $table->integer('sort_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('market_orders_payments', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });

        Schema::table('market_orders_deliveries', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
        
    }
}