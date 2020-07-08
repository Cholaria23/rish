<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketOrdersEntity extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders', function(Blueprint $table) {
            $table->string('client_type', 255)->default('individual');
            $table->string('entity_name', 255)->nullable();
            $table->string('entity_address', 255)->nullable();
            $table->string('entity_fact_address', 255)->nullable();
            $table->string('entity_code', 255)->nullable();
            $table->string('entity_bank_code', 255)->nullable();
            $table->string('inn', 255)->nullable();
            $table->string('bank_account', 255)->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->string('entity_registration_number', 255)->nullable();
            $table->string('entity_registration_date', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropColumn('client_type');
            $table->dropColumn('entity_name');
            $table->dropColumn('entity_address');
            $table->dropColumn('entity_fact_address');
            $table->dropColumn('entity_code');
            $table->dropColumn('entity_bank_code');
            $table->dropColumn('inn');
            $table->dropColumn('bank_account');
            $table->dropColumn('bank_name');
            $table->dropColumn('entity_registration_number');
            $table->dropColumn('entity_registration_date');
        });
    }
}