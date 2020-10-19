<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketBrandsSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function (Blueprint $table) {
            $table->boolean('is_brands_only_templates')->default(0);
            $table->boolean('is_series_only_templates')->default(0);
            $table->text('brands_meta_title_template')->nullable();
            $table->text('brands_meta_description_template')->nullable();
        });
        Schema::table('market_brands', function (Blueprint $table) {
            $table->string('changefreq', 255)->default('weekly');
            $table->boolean('is_noindex')->default(0);
        });
        Schema::table('market_brands_lang', function (Blueprint $table) {
            $table->string('h1', 255)->nullable();
            $table->string('add_meta_title', 255)->nullable();
            $table->text('series_meta_title_template')->nullable();
            $table->text('series_meta_description_template')->nullable();
        });
        Schema::table('market_brands_series', function (Blueprint $table) {
            $table->string('changefreq', 255)->default('weekly');
            $table->boolean('is_noindex')->default(0);
        });
        Schema::table('market_brands_series_lang', function (Blueprint $table) {
            $table->string('h1', 255)->nullable();
            $table->string('add_meta_title', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_brands_lang', function (Blueprint $table) {
            $table->dropColumn('h1');
            $table->dropColumn('add_meta_title');
            $table->dropColumn('series_meta_title_template');
            $table->dropColumn('series_meta_description_template');
        });
        Schema::table('market_brands', function (Blueprint $table) {
            $table->dropColumn('changefreq');
            $table->dropColumn('is_noindex');
        });
        Schema::table('market_brands_series', function (Blueprint $table) {
            $table->dropColumn('changefreq');
            $table->dropColumn('is_noindex');
        });
        Schema::table('market_brands_series_lang', function (Blueprint $table) {
            $table->dropColumn('h1');
            $table->dropColumn('add_meta_title');
        });
        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('is_brands_only_templates');
            $table->dropColumn('is_series_only_templates');
            $table->dropColumn('brands_meta_title_template');
            $table->dropColumn('brands_meta_description_template');
        });
    }
}