<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeadsFilters extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leads_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
        });
        Schema::create('leads_filters_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
        });
        Schema::table('leads_filters_lang', function(Blueprint $table) {
            $table->foreign('filter_id', 'leads_filters_lang_1')->references('id')->on('leads_filters')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });
        Schema::create('leads_filters_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id')->unsigned()->index();
            $table->integer('filter_id')->unsigned()->index();
        });
        Schema::table('leads_filters_leads', function(Blueprint $table) {
            $table->foreign('lead_id', 'leads_filters_leads_1')->references('id')->on('leads')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('filter_id', 'leads_filters_leads_2')->references('id')->on('leads_filters')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down() {
        Schema::table('leads_filters_leads', function (Blueprint $table) {
            $table->dropForeign('leads_filters_leads_1');
            $table->dropForeign('leads_filters_leads_2');
        });        
        Schema::dropIfExists('leads_filters_leads');

        Schema::table('leads_filters_lang', function (Blueprint $table) {
            $table->dropForeign('leads_filters_lang_1');
        });        
        Schema::dropIfExists('leads_filters_lang');
        Schema::dropIfExists('leads_filters');
    }
}