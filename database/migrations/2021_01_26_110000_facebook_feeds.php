<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FacebookFeeds extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function(Blueprint $table) {
            $table->boolean('add_cat_id')->default(0);
            $table->boolean('is_feed')->default(0);
        });

        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->boolean('is_list_feed')->default(1);
        });        

        Schema::table('market_categories', function(Blueprint $table) {
            $table->boolean('is_feed_id')->default(1);
            $table->boolean('is_feed')->default(1);
        });

        Schema::table('market_goods', function(Blueprint $table) {
            $table->boolean('is_feed')->default(1);
        });

        Schema::table('market_goods_lang', function(Blueprint $table) {
            $table->text('feed_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('add_cat_id');
            $table->dropColumn('is_feed');
        });

        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->dropColumn('is_list_feed');
        });

        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('is_feed_id');
            $table->dropColumn('is_feed');
        });

        Schema::table('market_goods', function (Blueprint $table) {
            $table->dropColumn('is_feed');
        });

        Schema::table('market_goods_lang', function (Blueprint $table) {
            $table->dropColumn('feed_description');
        });    
    }
}