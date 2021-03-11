<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoogleFeeds extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function(Blueprint $table) {
            $table->boolean('is_google_feed')->default(0);
        });

        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->boolean('is_list_google_feed')->default(1);
        });        

        Schema::table('market_categories', function(Blueprint $table) {
            $table->boolean('is_google_feed')->default(1);
            $table->string('google_cat_id')->nullable();
        });

        Schema::table('market_goods', function(Blueprint $table) {
            $table->boolean('is_google_feed')->default(1);
        });

        Schema::table('market_goods_lang', function(Blueprint $table) {
            $table->text('google_feed_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('is_google_feed');
        });

        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->dropColumn('is_list_google_feed');
        });

        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('is_google_feed');
            $table->dropColumn('google_cat_id');
        });

        Schema::table('market_goods', function (Blueprint $table) {
            $table->dropColumn('is_google_feed');
        });

        Schema::table('market_goods_lang', function (Blueprint $table) {
            $table->dropColumn('google_feed_description');
        });    
    }
}