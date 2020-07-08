<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders_goods', function(Blueprint $table) {
            $table->float('rate', 8, 2)->default(1); 
        });

        Schema::table('market_orders', function(Blueprint $table) {
            $table->float('discount', 8, 2)->default(0); 
            $table->float('discount_percent', 8, 2)->default(0); 
        });

        Schema::table('market_orders', function(Blueprint $table) {
            DB::statement("ALTER TABLE `market_orders` CHANGE `fathername_name` `father_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;");
        });

        Schema::table('market_orders_goods', function(Blueprint $table) {
            $table->increments('id');
        });         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->dropColumn('discount_percent');
        });
        Schema::table('market_orders_goods', function (Blueprint $table) {
            $table->dropColumn('rate');
        });
        Schema::table('market_orders', function(Blueprint $table) {
            DB::statement("ALTER TABLE `market_orders` CHANGE `father_name` `fathername_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;");
        });
        Schema::table('market_orders_goods', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
}