<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMarketChars extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {   



        Schema::table('market_chars', function(Blueprint $table) {
            $table->boolean('is_filter')->default(0);
            $table->boolean('is_in_list')->default(0);
            $table->boolean('is_specify')->default(0);
            $table->boolean('is_own')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_chars', function (Blueprint $table) {
            $table->dropColumn('is_filter');
            $table->dropColumn('is_in_list');
            $table->dropColumn('is_specify');
            $table->dropColumn('is_own');
        });
     
    }
}
