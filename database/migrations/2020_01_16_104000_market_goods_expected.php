<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketGoodsExpected extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_goods', function(Blueprint $table) {
            $table->boolean('is_expected')->default(0);
        });

        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->boolean('is_list_expected')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods', function(Blueprint $table) {
            $table->dropColumn('is_expected');
        });
        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->dropColumn('is_list_expected');
        });     
    }
}