<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodTempPlacement extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {


        Schema::create('market_goods_temp_placement', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('good_id');
            $table->unsignedInteger('storage_id');
            $table->integer('amount')->default(0);

            $table->foreign('storage_id', 'market_goods_temp_placement_storage_id_ibfk')->references('id')->on('market_storages')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('good_id', 'market_goods_temp_placement_good_id_ibfk')->references('id')->on('market_goods')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_placement', function (Blueprint $table) {
            $table->dropForeign('market_goods_temp_placement_storage_id_ibfk');
            $table->dropForeign('market_goods_temp_placement_good_id_ibfk');
        });
        Schema::dropIfExists('market_goods_placement');
    }
}
