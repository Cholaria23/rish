<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MonobankOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('market_orders', function (Blueprint $table) {
            $table->datetime('monobank_request')->nullable();
            $table->datetime('monobank_answer')->nullable();
            $table->string('monobank_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropColumn('monobank_request');
            $table->dropColumn('monobank_answer');
            $table->dropColumn('monobank_status');
        });
    }
}