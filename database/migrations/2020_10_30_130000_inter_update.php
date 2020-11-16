<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InterUpdate extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->string('type', 255)->default('info');
        });

        Schema::table('interactive_images_dots_units', function (Blueprint $table) {
            $table->dropForeign('interactive_images_dots_units_unit_id');
            $table->foreign('unit_id', 'interactive_images_dots_units_unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
