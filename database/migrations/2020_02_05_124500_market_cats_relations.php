<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketCatsRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories', function(Blueprint $table) {
            $table->boolean('is_tag')->default(0);
        });

        Schema::table('market_goods_rel_types', function(Blueprint $table) {
            $table->boolean('is_cats_relation')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories', function(Blueprint $table) {
            $table->dropColumn('is_tag');
        }); 
        
        Schema::table('market_goods_rel_types', function(Blueprint $table) {
            $table->dropColumn('is_cats_relation');
        }); 
    }
}