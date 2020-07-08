<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketMiniImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('market_categories', function(Blueprint $table) {
            $table->string('mini_aspect_cover', 255)->default('1:1');
            $table->string('mini_width_cover', 255)->default('100');
            $table->string('mini_aspect_gallery', 255)->default('1:1');
            $table->string('mini_width_gallery', 255)->default('100');
        });

        Schema::table('market_brands', function(Blueprint $table) {
            $table->string('mini_aspect_gallery', 255)->default('1:1');
            $table->string('mini_width_gallery', 255)->default('100');
        });

        Schema::table('market_params', function(Blueprint $table) {
            $table->string('brands_mini_aspect_cover', 255)->default('1:1');
            $table->string('brands_mini_width_cover', 255)->default('100');
        });

        \Storage::disk('public')->makeDirectory('market/categories/mini');
        \Storage::disk('public')->makeDirectory('market/brands/mini');
        \Storage::disk('public')->makeDirectory('market/mini');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories', function(Blueprint $table) {
            $table->dropColumn('mini_aspect_cover');
            $table->dropColumn('mini_width_cover');
            $table->dropColumn('mini_aspect_gallery');
            $table->dropColumn('mini_width_gallery');
        });
        Schema::table('market_brands', function(Blueprint $table) {
            $table->dropColumn('mini_aspect_gallery');
            $table->dropColumn('mini_width_gallery');
        });
        Schema::table('market_params', function(Blueprint $table) {
            $table->dropColumn('brands_mini_aspect_cover');
            $table->dropColumn('brands_mini_width_cover');
        });   
    }
}