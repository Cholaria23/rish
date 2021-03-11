<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecEd extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('specialists_lang', function(Blueprint $table) {
            DB::statement("ALTER TABLE `specialists_lang` CHANGE `education` `education` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;");
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_lang', function(Blueprint $table) {
            DB::statement("ALTER TABLE `specialists_lang` CHANGE `education` `education` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ");
        });
    }
}

 
