<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MentorsAdminParams extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('specialists_params', function (Blueprint $table) {
            $table->integer('page_count_admin')->default(20);
            $table->text('fields')->nullable();
        });

        DB::table('specialists_params')->where('id', 1)->update([
            'fields' => 'name,seo,chars,short_desc_1,long_desc_1,contacts,photo,images_1,units_relations,params'
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_params', function (Blueprint $table) {
            $table->dropColumn('page_count_admin');
            $table->dropColumn('fields');
        });
    }
}
