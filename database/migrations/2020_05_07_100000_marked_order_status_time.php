<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarkedOrderStatusTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent_id = DB::table('sections')->where('alias', 'market')->first()->id;
        DB::table('sections')->insert([
                                          [
                                              'alias' => 'market_orders_statistic',
                                              'lang_name' => 'Market::main.sections.market_orders_statistic',
                                              'route' => 'admin.market.ordersStatistic',
                                              'parent_id' => $parent_id
                                          ]
                                      ]);

        Schema::create('market_orders_statuses_date',function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('status_id');
            $table->dateTime('date');
        });

        Schema::table('market_orders_statuses_date',function (Blueprint $table){
            $table->foreign('order_id', 'market_orders_statuses_date_order_id_ibfk')->references('id')->on('market_orders')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('status_id', 'market_orders_statuses_date_status_id_ibfk')->references('id')->on('market_orders_statuses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `market_orders_statuses_date` DROP FOREIGN KEY `market_orders_statuses_date_order_id_ibfk`;');
        DB::statement('ALTER TABLE `market_orders_statuses_date` DROP FOREIGN KEY `market_orders_statuses_date_status_id_ibfk`;');

        Schema::dropIfExists('market_orders_statuses_date');

        DB::table('sections')->where('alias', 'market_orders_statistic')->delete();
    }
}
