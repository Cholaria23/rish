<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketFixGoodDimensions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('market_goods', function(Blueprint $table) {
            DB::statement("ALTER TABLE `market_goods` CHANGE `length` `length` FLOAT(8,2) NOT NULL DEFAULT '0'; ");
            DB::statement("ALTER TABLE `market_goods` CHANGE `width` `width` FLOAT(8,2) NOT NULL DEFAULT '0'; ");
            DB::statement("ALTER TABLE `market_goods` CHANGE `height` `height` FLOAT(8,2) NOT NULL DEFAULT '0'; ");
            DB::statement("ALTER TABLE `market_goods` CHANGE `weight` `weight` FLOAT(8,2) NOT NULL DEFAULT '0'; ");
            DB::statement("ALTER TABLE `market_goods` CHANGE `volume` `volume` FLOAT(8,2) NOT NULL DEFAULT '0'; ");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods', function(Blueprint $table) {
            DB::statement("ALTER TABLE `market_goods` CHANGE `length` `length` INT(11) NOT NULL DEFAULT '0'; ");
            DB::statement("ALTER TABLE `market_goods` CHANGE `width` `width` INT(11) NOT NULL DEFAULT '0'; ");
            DB::statement("ALTER TABLE `market_goods` CHANGE `height` `height` INT(11) NOT NULL DEFAULT '0'; ");
            DB::statement("ALTER TABLE `market_goods` CHANGE `weight` `weight` INT(11) NOT NULL DEFAULT '0'; ");
            DB::statement("ALTER TABLE `market_goods` CHANGE `volume` `volume` INT(11) NOT NULL DEFAULT '0'; ");
        });
    }
}