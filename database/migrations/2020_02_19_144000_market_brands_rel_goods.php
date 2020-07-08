<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketBrandsRelGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('market_goods_brands', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('good_id')->unsigned()->index();
            $table->integer('series_id')->unsigned()->index();
            $table->integer('goods_sort_order')->default(0);
            $table->integer('brands_sort_order')->default(0);
        });

        Schema::table('market_goods_brands', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_brands_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('series_id', 'market_goods_brands_2')->references('id')->on('market_brands_series')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_brands', function (Blueprint $table) {
            $table->dropForeign('market_goods_brands_1');
            $table->dropForeign('market_goods_brands_2');
        });
        Schema::dropIfExists('market_goods_brands'); 
    }
}