<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SliderInfo extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('slider', function (Blueprint $table) {
            $table->string('img_desktop', 255)->nullable();
            $table->string('img_mobile', 255)->nullable();
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn('img_desktop');
            $table->dropColumn('img_mobile');
        });
    }
}
