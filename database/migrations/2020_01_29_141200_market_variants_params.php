<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketVariantsParams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->string('variants_view')->default('varians_as_sub_good');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->dropColumn('variants_view');
        });
      
    }
}