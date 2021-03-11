<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketMenuConstructor extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->integer('market_cat_id')->nullable()->unsigned()->index();
            $table->integer('good_id')->nullable()->unsigned()->index();
        });
        Schema::table('menu_items', function (Blueprint $table) {
            $table->foreign('market_cat_id', 'menu_items_ibfk_5')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('good_id', 'menu_items_ibfk_6')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign('menu_items_ibfk_5');
            $table->dropForeign('menu_items_ibfk_6');
        });
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('market_cat_id');
            $table->dropColumn('good_id');
        });
    }
}
