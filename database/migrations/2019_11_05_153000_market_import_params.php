<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketImportParams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->text('import_template')->nullable();
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->dropColumn('import_template');
        });
        
    }
}

