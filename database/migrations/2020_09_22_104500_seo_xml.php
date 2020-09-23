<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeoXml extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_categories', function(Blueprint $table) {
            $table->string('xml_cat_rule')->nullable();
            $table->string('xml_unit_rule')->nullable()->default('{cat_alias}');
            $table->string('changefreq')->default('daily');

        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories', function(Blueprint $table) {
            $table->dropColumn('xml_cat_rule');
            $table->dropColumn('xml_unit_rule');
            $table->dropColumn('changefreq');
        });
    }
}