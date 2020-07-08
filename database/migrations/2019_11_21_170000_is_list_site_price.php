<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IsListSitePrice extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->boolean('is_list_site_price')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->dropColumn('is_list_site_price');
        });
     
    }
}