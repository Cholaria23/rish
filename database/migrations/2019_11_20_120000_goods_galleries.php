<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsGalleries extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {       

        Schema::create('galleries_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
            $table->integer('gallery_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('galleries_goods', function(Blueprint $table) {
            $table->foreign('good_id', 'galleries_goods_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('gallery_id', 'galleries_goods_2')->references('id')->on('galleries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('galleries_goods', function (Blueprint $table) {
            $table->dropForeign('galleries_goods_1');
            $table->dropForeign('galleries_goods_2');
        });
        Schema::drop('galleries_goods');    
    }
}
