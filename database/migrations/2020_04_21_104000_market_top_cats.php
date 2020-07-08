<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketTopCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories', function (Blueprint $table) {
            $table->boolean('is_top')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {        
        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('is_top');
        });
    }
}
