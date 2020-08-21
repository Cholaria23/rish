<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsCatsRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('market_units_cats_relations', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('market_cat_id')->nullable()->index()->unsigned();
            $table->integer('units_cat_id')->nullable()->index()->unsigned();
            $table->foreign('market_cat_id', 'market_units_cats_1')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('units_cat_id', 'market_units_cats_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_units_cats_relations', function (Blueprint $table) {
            $table->dropForeign('market_units_cats_1');
            $table->dropForeign('market_units_cats_2');
        });
        Schema::dropIfExists('market_units_cats_relations'); 
    }
}