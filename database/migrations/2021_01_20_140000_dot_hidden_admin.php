<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DotHiddenAdmin extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->boolean('is_hidden_admin', 255)->default(0);
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->dropColumn('is_hidden_admin');
        });
    }
}
