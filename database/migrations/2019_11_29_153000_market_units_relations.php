<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketUnitsRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('market_goods_units_cats_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->foreign('good_id', 'market_goods_units_cats_relations_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'market_goods_units_cats_relations_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('units_goods_relations', function (Blueprint $table) {
            $table->integer('goods_sort_order')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_units_cats_relations', function (Blueprint $table) {
            $table->dropForeign('market_goods_units_cats_relations_1');
            $table->dropForeign('market_goods_units_cats_relations_2');
        });
        Schema::dropIfExists('market_goods_units_cats_relations');

        Schema::table('units_goods_relations', function (Blueprint $table) {
            $table->dropColumn('goods_sort_order');
        });

        
    }
}