<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketInter extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('interactive_images', function (Blueprint $table) {
            $table->unsignedInteger('good_id')->nullable();
        });

        Schema::table('interactive_images', function (Blueprint $table) {
            $table->foreign('good_id', 'interactive_images_good_id')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('interactive_images_dots_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dot_id')->unsigned()->index();
            $table->integer('good_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('interactive_images_dots_goods', function (Blueprint $table) {
            $table->foreign('dot_id', 'interactive_images_dots_goods_good_id')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('dot_id', 'interactive_images_dots_goods_dot_id')->references('id')->on('interactive_images_dots')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('interactive_images', function (Blueprint $table) {
            $table->dropForeign( 'interactive_images_good_id');
        });
        Schema::table('interactive_images', function (Blueprint $table) {
            $table->dropColumn( 'good_id');
        });

        Schema::table('interactive_images_dots_goods', function (Blueprint $table) {
            $table->dropForeign( 'interactive_images_dots_goods_good_id');
            $table->dropForeign( 'interactive_images_dots_goods_dot_id');
        });
        Schema::dropIfExists('interactive_images_dots_goods');

    }
}
