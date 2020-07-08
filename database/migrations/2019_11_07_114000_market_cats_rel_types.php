<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketCatsRelTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('market_cats_relations', function(Blueprint $table) {
            $table->integer('rel_type_id')->nullable()->index()->unsigned();
            $table->foreign('rel_type_id', 'market_cats_relations_3')->references('id')->on('market_goods_rel_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_cats_relations', function (Blueprint $table) {
            $table->dropForeign('market_cats_relations_3');
            $table->dropColumn('rel_type_id');
        });        
    }
}