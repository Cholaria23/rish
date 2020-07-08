<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketWishlistUserPriceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('market_wishlists', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->string('name', 255)->nullable();
            $table->timestamps();
        });

        Schema::table('market_wishlists', function(Blueprint $table) {
            $table->foreign('user_id', 'market_wishlists_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_wishlists_goods', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('wishlist_id')->nullable()->unsigned()->index();
            $table->integer('good_id')->nullable()->unsigned()->index();
        });

        Schema::table('market_wishlists_goods', function(Blueprint $table) {
            $table->foreign('good_id', 'market_wishlists_goods_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('wishlist_id', 'market_wishlists_goods_2')->references('id')->on('market_wishlists')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->integer('price_type_id')->nullable()->unsigned()->index();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->foreign('price_type_id', 'users_1')->references('id')->on('market_price_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_wishlists_goods', function (Blueprint $table) {
            $table->dropForeign('market_wishlists_goods_1');
            $table->dropForeign('market_wishlists_goods_2');
        });
        Schema::dropIfExists('market_wishlists_goods');

        Schema::table('market_wishlists', function (Blueprint $table) {
            $table->dropForeign('market_wishlists_1');
        });
        Schema::dropIfExists('market_wishlists');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_1');
            $table->dropColumn('price_type_id');
        });
    }
}