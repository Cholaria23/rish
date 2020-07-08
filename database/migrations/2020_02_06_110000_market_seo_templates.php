<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketSeoTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function(Blueprint $table) {
            $table->boolean('is_goods_only_templates')->default(0);
            $table->boolean('is_cats_only_templates')->default(0);
        });

        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->text('meta_title_template')->nullable();
            $table->text('meta_description_template')->nullable();
            $table->text('good_meta_title_template')->nullable();
            $table->text('good_meta_description_template')->nullable();
            $table->text('good_long_desc_template')->nullable();
        });

            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_params', function(Blueprint $table) {
            $table->dropColumn('is_goods_only_templates');
            $table->dropColumn('is_cats_only_templates');
        });

        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->dropColumn('meta_title_template');
            $table->dropColumn('meta_description_template');
            $table->dropColumn('good_meta_title_template');
            $table->dropColumn('good_meta_description_template');
            $table->dropColumn('good_long_desc_template');
        }); 
    }
}