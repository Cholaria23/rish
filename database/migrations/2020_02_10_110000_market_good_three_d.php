<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketGoodThreeD extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('market_goods_three_d', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('good_id')->nullable()->unsigned()->index();
            $table->string('src', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_goods_three_d', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_three_d_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_three_d', function (Blueprint $table) {
            $table->dropForeign('market_goods_three_d_1');
        });
        Schema::dropIfExists('market_goods_three_d');        
    }
}