<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketSeoXml extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories', function(Blueprint $table) {
            $table->string('xml_cat_rule')->nullable();
            $table->string('xml_good_rule')->nullable()->default('{cat_alias}');
            $table->string('changefreq')->default('daily');
        });

        Schema::table('market_params', function(Blueprint $table) {
            $table->string('xml_rule')->default('catalog');
        });           
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories', function(Blueprint $table) {
            $table->dropColumn('xml_cat_rule');
            $table->dropColumn('xml_good_rule');
            $table->dropColumn('changefreq');
        });
        Schema::table('market_params', function(Blueprint $table) {
            $table->dropColumn('xml_rule');
        });
    }
}