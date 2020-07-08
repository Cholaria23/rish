<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MiniImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('units_categories', function(Blueprint $table) {
            $table->string('mini_aspect_cover', 255)->default('1:1');
            $table->string('mini_width_cover', 255)->default('100');
            $table->string('mini_aspect_gallery', 255)->default('1:1');
            $table->string('mini_width_gallery', 255)->default('100');
        });

        Schema::table('galleries', function(Blueprint $table) {
            $table->string('mini_aspect', 255)->default('1:1');
            $table->string('mini_width', 255)->default('100');
        });
        \Storage::disk('public')->makeDirectory('units/categories/mini');
        \Storage::disk('public')->makeDirectory('units/mini');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories', function(Blueprint $table) {
            $table->dropColumn('mini_aspect_cover');
            $table->dropColumn('mini_width_cover');
            $table->dropColumn('mini_aspect_gallery');
            $table->dropColumn('mini_width_gallery');
        });
        Schema::table('galleries', function(Blueprint $table) {
            $table->dropColumn('mini_aspect');
            $table->dropColumn('mini_width');
        });      
    }
}