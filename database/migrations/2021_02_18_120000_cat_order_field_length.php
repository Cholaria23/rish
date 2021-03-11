<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatOrderFieldLength extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories', function(Blueprint $table) {
            DB::statement("ALTER TABLE `market_categories` CHANGE `goods_default_sort` `goods_default_sort` VARCHAR(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'created_at_desc'; ");            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories', function(Blueprint $table) {
            DB::statement("ALTER TABLE `market_categories` CHANGE `goods_default_sort` `goods_default_sort` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'created_at_desc'; ");            
        });
    }
}