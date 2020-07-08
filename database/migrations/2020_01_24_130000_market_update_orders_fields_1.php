<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketUpdateOrdersFields1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders', function(Blueprint $table) {
            $table->string('ttn')->nullable();
            $table->boolean('delivery_free')->default(0);
            $table->float('advance', 8, 2)->default(0);
        });

        Schema::table('market_virtual_goods', function(Blueprint $table) {
            $table->string('article')->nullable();
        });

               
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {  
        Schema::table('market_orders', function(Blueprint $table) {
            $table->dropColumn('ttn');
            $table->dropColumn('delivery_free');
            $table->dropColumn('advance');
        });
        Schema::table('market_virtual_goods', function(Blueprint $table) {
            $table->dropColumn('article');
        });
    }
}