<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories', function(Blueprint $table) {
            $table->string('small_aspect_gallery', 255)->default('4:3');
            $table->string('thumb_aspect_gallery', 255)->default('4:3');
            $table->string('big_width_gallery', 255)->default('2000');
            $table->string('small_width_gallery', 255)->default('500');
            $table->string('thumb_width_gallery', 255)->default('200');
            $table->boolean('is_fill_gallery')->default(0);
        });

        Schema::create('market_goods_images', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('good_id')->nullable()->unsigned()->index();
            $table->string('src', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_goods_images', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_images_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_goods_images_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
        });

        Schema::table('market_goods_images_lang', function(Blueprint $table) {
            $table->foreign('image_id', 'market_goods_images_lang_1')->references('id')->on('market_goods_images')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_images_lang', function (Blueprint $table) {
            $table->dropForeign('market_goods_images_lang_1');
        });
        Schema::dropIfExists('market_goods_images_lang');

        Schema::table('market_goods_images', function (Blueprint $table) {
            $table->dropForeign('market_goods_images_1');
        });
        Schema::dropIfExists('market_goods_images');

        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('small_aspect_gallery');
            $table->dropColumn('thumb_aspect_gallery');
            $table->dropColumn('big_width_gallery');
            $table->dropColumn('small_width_gallery');
            $table->dropColumn('thumb_width_gallery');
            $table->dropColumn('is_fill_gallery');
        });

        
    }
}