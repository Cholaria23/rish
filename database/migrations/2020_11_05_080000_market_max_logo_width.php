<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketMaxLogoWidth extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function (Blueprint $table) {            
            $table->string('brands_width_logo', 255)->nullable()->default(250);
            $table->boolean('brands_use_logo_width')->default(1); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('brands_width_logo');
            $table->dropColumn('brands_use_logo_width');
        });
    }
}
