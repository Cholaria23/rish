<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->text('tags')->nullable();
        });
        Schema::table('market_categories', function(Blueprint $table) {
            $table->boolean('is_listing')->default(0);
        }); 

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->dropColumn('tags');
        });
        Schema::table('market_categories', function(Blueprint $table) {
            $table->dropColumn('is_listing');
        });
    }
}
