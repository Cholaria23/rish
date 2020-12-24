<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FaqExtUnit extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('faq', function (Blueprint $table) {
            $table->integer('ext_unit_id')->nullable()->index()->unsigned();
        });  


        Schema::table('faq', function(Blueprint $table) {
            $table->foreign('ext_unit_id', 'ext_unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('faq', function (Blueprint $table) {
            $table->dropForeign('ext_unit_id');
        });
        Schema::table('faq', function (Blueprint $table) {
            $table->dropColumn('ext_unit_id');
        });
    }
}
