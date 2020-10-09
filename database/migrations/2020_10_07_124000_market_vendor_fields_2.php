<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketVendorFields2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_vendors', function(Blueprint $table) {
            $table->boolean('is_auto_remains')->default(0);
            $table->boolean('is_auto_new')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_vendors', function (Blueprint $table) {
            $table->dropColumn('is_auto_remains');
            $table->dropColumn('is_auto_new');
        });        
    }
}