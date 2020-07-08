<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketBrandsSoftDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_brands', function(Blueprint $table) {
            $table->text('deleted_by')->nullable();
            $table->text('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_brands', function(Blueprint $table) {
            $table->dropColumn('deleted_by');
            $table->dropColumn('created_by');
        });   
    }
}