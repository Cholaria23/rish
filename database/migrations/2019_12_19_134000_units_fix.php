<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_rel_types', function(Blueprint $table) {
            DB::statement("ALTER TABLE `units_rel_types` CHANGE `name` `name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ");
        });

        DB::table('units_rel_types')->where('name', 'direct')->update(['name' => '{"uk":"\u041e\u0441\u043d\u043e\u0432\u043d\u0438\u0439","ru":"\u041e\u0441\u043d\u043e\u0432\u043d\u0430\u044f \u0441\u0432\u044f\u0437\u044c"}']);

        Schema::table('additions', function(Blueprint $table) {
            $table->string('valign', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('additions', function(Blueprint $table) {
            $table->dropColumn('valign');
        });        
        Schema::table('units_rel_types', function(Blueprint $table) {
            DB::statement("ALTER TABLE `units_rel_types` CHANGE `name` `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;");
        });
    }
}