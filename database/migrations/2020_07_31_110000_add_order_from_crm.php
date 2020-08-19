<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderFromCrm extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders', function(Blueprint $table) {
            $table->boolean('is_from_crm')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders', function(Blueprint $table) {
            $table->dropColumn('is_from_crm');
        });
    }
}






