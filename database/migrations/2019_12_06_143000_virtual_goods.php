<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VirtualGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('market_virtual_goods', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('order_id')->unsigned()->index();
            $table->string('name', 255)->nullable();
            $table->integer('count')->default(1);
            $table->float('price', 8, 2)->default(0);
        });
        Schema::table('market_virtual_goods', function(Blueprint $table) {
            $table->foreign('order_id', 'market_virtual_goods_1')->references('id')->on('market_orders')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_virtual_goods', function (Blueprint $table) {
            $table->dropForeign('market_virtual_goods_1');
        });
        Schema::dropIfExists('market_virtual_goods');        
    }
}