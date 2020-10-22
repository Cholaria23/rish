<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FaqRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('faq_specialists_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('faq_group_id');
            $table->unsignedInteger('specialist_id');
            $table->integer('sort_order')->default(0);
        });

        Schema::table('faq_specialists_relations', function (Blueprint $table) {
            $table->foreign('faq_group_id', 'faq_specialists_relations_faq_group_id_ibfk')->references('id')->on('faq_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('specialist_id', 'faq_specialists_relations_specialist_id_ibfk')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('faq_specialists_relations', function (Blueprint $table) {
            $table->dropForeign( 'faq_specialists_relations_faq_group_id_ibfk');
            $table->dropForeign( 'faq_specialists_relations_specialist_id_ibfk');
        });
        Schema::dropIfExists('faq_specialists_relations');
    }
}
