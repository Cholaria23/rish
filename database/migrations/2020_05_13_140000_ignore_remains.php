<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IgnoreRemains extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function(Blueprint $table) {
            $table->boolean('ignore_remains')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('ignore_remains');
        });
     
    }
}