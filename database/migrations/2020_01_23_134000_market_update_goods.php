<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketUpdateGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_goods', function(Blueprint $table) {
            $table->boolean('is_action')->default(0);
            $table->boolean('is_free_delivery')->default(0);
            $table->boolean('is_super_price')->default(0);
            $table->boolean('is_yml_show')->default(0);
            $table->boolean('is_secret')->default(0);
        });

        Schema::table('market_goods_relations', function(Blueprint $table) {
            $table->string('default_num')->nullable();
            $table->string('min_num')->nullable();
            $table->string('max_num')->nullable();
        });

        Schema::table('market_prices', function(Blueprint $table) {
            $table->boolean('is_gift_price')->default(0);
            $table->boolean('is_hidden')->default(0);            
        });


        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_prices', function(Blueprint $table) {
            $table->dropColumn('is_gift_price');
            $table->dropColumn('is_hidden');
        });  
        Schema::table('market_goods_relations', function(Blueprint $table) {
            $table->dropColumn('default_num');
            $table->dropColumn('min_num');
            $table->dropColumn('max_num');
        });  
        Schema::table('market_goods', function(Blueprint $table) {
            $table->dropColumn('is_action');
            $table->dropColumn('is_free_delivery');
            $table->dropColumn('is_super_price');
            $table->dropColumn('is_yml_show');
            $table->dropColumn('is_secret');
        });  
    }
}