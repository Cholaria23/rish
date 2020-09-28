<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeoXmlSpecialists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('specialists_params', function(Blueprint $table) {
            $table->string('xml_rule')->nullable();
            $table->string('changefreq')->defoult('weekly');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_params', function(Blueprint $table) {
            $table->dropColumn('xml_rule');
            $table->dropColumn('changefreq');
        });
    }
}