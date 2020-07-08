<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsCharsText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::table('units_chars_relations', function (Blueprint $table) {
        DB::statement("ALTER TABLE `units_chars_relations` CHANGE `own_value` `own_value` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;  ");
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::table('units_chars_relations', function (Blueprint $table) {
        DB::statement("ALTER TABLE `units_chars_relations` CHANGE `own_value` `own_value` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ");
      });
    }
}
