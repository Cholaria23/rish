<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketBrandsGlobalImgParams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function(Blueprint $table) {
            $table->string('brands_series_small_aspect_gallery', 255)->default('4:3');
            $table->string('brands_series_thumb_aspect_gallery', 255)->default('4:3');
            $table->string('brands_series_mini_aspect_gallery', 255)->default('4:3');
            $table->string('brands_series_big_width_gallery', 255)->default('2000');
            $table->string('brands_series_small_width_gallery', 255)->default('500');
            $table->string('brands_series_thumb_width_gallery', 255)->default('200');
            $table->string('brands_series_mini_width_gallery', 255)->default('200');
            $table->boolean('brands_series_is_fill_gallery')->default(0);
        });

        Schema::table('market_brands', function(Blueprint $table) {
            $table->dropColumn('small_aspect_gallery');
            $table->dropColumn('thumb_aspect_gallery');
            $table->dropColumn('mini_aspect_gallery');
            $table->dropColumn('big_width_gallery');
            $table->dropColumn('small_width_gallery');
            $table->dropColumn('thumb_width_gallery');
            $table->dropColumn('mini_width_gallery');
            $table->dropColumn('is_fill_gallery');
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('market_brands', function(Blueprint $table) {
            $table->string('small_aspect_gallery', 255)->default('4:3');
            $table->string('thumb_aspect_gallery', 255)->default('4:3');
            $table->string('mini_aspect_gallery', 255)->default('4:3');
            $table->string('big_width_gallery', 255)->default('2000');
            $table->string('small_width_gallery', 255)->default('500');
            $table->string('thumb_width_gallery', 255)->default('200');
            $table->string('mini_width_gallery', 255)->default('200');
            $table->boolean('is_fill_gallery')->default(0);
        });

        
        Schema::table('market_params', function(Blueprint $table) {
            $table->dropColumn('brands_series_small_aspect_gallery');
            $table->dropColumn('brands_series_thumb_aspect_gallery');
            $table->dropColumn('brands_series_mini_aspect_gallery');
            $table->dropColumn('brands_series_big_width_gallery');
            $table->dropColumn('brands_series_small_width_gallery');
            $table->dropColumn('brands_series_thumb_width_gallery');
            $table->dropColumn('brands_series_mini_width_gallery');
            $table->dropColumn('brands_series_is_fill_gallery');
        });
    }
}