<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketFix0 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('market_categories', function(Blueprint $table) {
            $table->boolean('is_hidden_bc')->default(0);
            DB::statement("ALTER TABLE `market_categories` CHANGE `is_hidden_menu` `is_hidden_menu` TINYINT(1) NOT NULL DEFAULT '0';");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('is_hidden_bc');
            DB::statement("ALTER TABLE `market_categories` CHANGE `is_hidden_menu` `is_hidden_menu` TINYINT(1) NOT NULL DEFAULT '1';");
        });        
    }
}