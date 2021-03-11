<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketGoodsUnits extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_goods_lang', function(Blueprint $table) {
            $table->string('good_units')->nullable();
        });
        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->boolean('is_list_good_units')->default(0);
            $table->boolean('is_list_hot_good_units')->default(0);
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_lang', function (Blueprint $table) {
            $table->dropColumn('good_units');
        });
        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->dropColumn('is_list_good_units');
            $table->dropColumn('is_list_hot_good_units');
        });
    }
}
