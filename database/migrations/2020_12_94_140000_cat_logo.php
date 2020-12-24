<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatLogo extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_categories', function (Blueprint $table) {
            $table->string('logo', 255)->nullable();
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories', function (Blueprint $table) {
            $table->dropColumn('logo');
        });
    }
}
