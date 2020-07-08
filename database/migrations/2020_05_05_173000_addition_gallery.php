<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionGallery extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('additions_types')->insert([
            ['alias' => "gallery", 'package' => "default", 'is_hidden' => 0, 'is_expandable' => 0,'is_solo' => 1, 'sort_order' => 3],
        ]);

        $type_id = DB::table('additions_types')->where('alias', 'gallery')->first()->id;
        DB::table('additions_lang_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "title", 'data_type' => "varchar"],
        ]);

        DB::table('additions_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "gallery_id", 'data_type' => "foreign_id"],
        ]);

        Schema::table('units_chars_relations', function (Blueprint $table) {
            DB::statement("ALTER TABLE `additions` CHANGE `is_wide` `is_wide` TINYINT(1) NOT NULL DEFAULT '0'; ");
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $type_id = DB::table('additions_types')->where('alias', 'gallery')->delete();
        Schema::table('units_chars_relations', function (Blueprint $table) {
            DB::statement("ALTER TABLE `additions` CHANGE `is_wide` `is_wide` TINYINT(1) NOT NULL DEFAULT '1'; ");
        }); 
    }
}
