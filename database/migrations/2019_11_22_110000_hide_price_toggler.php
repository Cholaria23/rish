<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HidePriceToggler extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function(Blueprint $table) {
            $table->boolean('is_show_price_toggler')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('is_show_price_toggler');
        });
     
    }
}