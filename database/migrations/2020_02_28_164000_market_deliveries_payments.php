<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketDeliveriesPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('market_orders_deliveries_payments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('delivery_id')->unsigned()->index();
            $table->integer('payment_id')->unsigned()->index();
        });

        Schema::table('market_orders_deliveries_payments', function(Blueprint $table) {
            $table->foreign('delivery_id', 'market_orders_deliveries_payments_1')->references('id')->on('market_orders_payments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('payment_id', 'market_orders_deliveries_payments_2')->references('id')->on('market_orders_deliveries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('market_orders_deliveries_payments')->where('id', '>', '0')->delete();
        DB::table('market_orders_deliveries_payments')->insert([
            ['id' => 1,  'delivery_id' => 1, 'payment_id' => 1],
            ['id' => 2,  'delivery_id' => 2, 'payment_id' => 1],
            ['id' => 3,  'delivery_id' => 3, 'payment_id' => 1],
            ['id' => 4,  'delivery_id' => 5, 'payment_id' => 1],
            ['id' => 5,  'delivery_id' => 2, 'payment_id' => 2],
            ['id' => 6,  'delivery_id' => 3, 'payment_id' => 2],
            ['id' => 7,  'delivery_id' => 4, 'payment_id' => 2],
            ['id' => 8,  'delivery_id' => 5, 'payment_id' => 2],
            ['id' => 9,  'delivery_id' => 2, 'payment_id' => 3],
            ['id' => 10, 'delivery_id' => 3, 'payment_id' => 3],
            ['id' => 11, 'delivery_id' => 4, 'payment_id' => 3],
            ['id' => 12, 'delivery_id' => 5, 'payment_id' => 3],
            ['id' => 13, 'delivery_id' => 1, 'payment_id' => 5],
            ['id' => 14, 'delivery_id' => 2, 'payment_id' => 5],
            ['id' => 15, 'delivery_id' => 3, 'payment_id' => 5],
            ['id' => 16, 'delivery_id' => 4, 'payment_id' => 5],
            ['id' => 17, 'delivery_id' => 5, 'payment_id' => 5],
            ['id' => 18, 'delivery_id' => 1, 'payment_id' => 4],
            ['id' => 19, 'delivery_id' => 2, 'payment_id' => 4],
            ['id' => 20, 'delivery_id' => 3, 'payment_id' => 4],
            ['id' => 21, 'delivery_id' => 5, 'payment_id' => 4],
        ]);
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
        Schema::dropIfExists('market_orders_deliveries_payments'); 
    }
}