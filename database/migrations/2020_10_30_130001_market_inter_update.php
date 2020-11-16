<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketInterUpdate extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->boolean('is_cart')->default(1); 
        });

        Schema::table('interactive_images_dots_goods', function (Blueprint $table) {
            $table->dropForeign('interactive_images_dots_goods_good_id');
            $table->foreign('good_id', 'interactive_images_dots_goods_good_id')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->dropColumn('is_cart');
        });
    }
}
