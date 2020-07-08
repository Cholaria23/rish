<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketActions extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {       

        Schema::create('market_goods_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
        });

        Schema::table('market_goods_actions', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_actions_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('unit_id', 'market_goods_actions_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_cats_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
        });

        Schema::table('market_cats_actions', function(Blueprint $table) {
            $table->foreign('cat_id', 'market_cats_actions_1')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('unit_id', 'market_cats_actions_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_actions', function (Blueprint $table) {
            $table->dropForeign('market_goods_actions_1');
            $table->dropForeign('market_goods_actions_2');
        });
        Schema::drop('market_goods_actions');

        Schema::table('market_cats_actions', function (Blueprint $table) {
            $table->dropForeign('market_cats_actions_1');
            $table->dropForeign('market_cats_actions_2');
        });
        Schema::drop('market_cats_actions');    
    }
}
