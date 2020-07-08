<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketGoodsFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('market_goods_files', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('good_id')->unsigned()->index();
            $table->integer('file_id')->nullable()->index()->unsigned();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('market_goods_files', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_files_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('file_id', 'market_goods_files_2')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_files', function (Blueprint $table) {
            $table->dropForeign('market_goods_files_1');
            $table->dropForeign('market_goods_files_2');
        });
        Schema::dropIfExists('market_goods_files');        
    }
}