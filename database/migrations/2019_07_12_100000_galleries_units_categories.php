<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GalleriesUnitsCategories extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('galleries_units_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('gallery_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });
        Schema::table('galleries_units_categories', function(Blueprint $table) {
            $table->foreign('cat_id', 'galleries_units_categories_1')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('gallery_id', 'galleries_units_categories_2')->references('id')->on('galleries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('galleries_units_categories', function (Blueprint $table) {
            $table->dropForeign('galleries_units_categories_1');
            $table->dropForeign('galleries_units_categories_2');
        });
        Schema::drop('galleries_units_categories');       
    }
}