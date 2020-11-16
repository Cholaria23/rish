<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InterGalleries extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->unsignedInteger('gallery_id')->nullable();
        });
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->foreign('gallery_id', 'interactive_images_dots_gallery_id')->references('id')->on('galleries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {        
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->dropForeign( 'interactive_images_dots_gallery_id');
        });
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->dropColumn('gallery_id');
        });
    }
}
