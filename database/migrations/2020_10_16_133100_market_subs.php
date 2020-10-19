<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketSubs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories', function (Blueprint $table) {
            $table->boolean('is_subs')->default(0);
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->text('market_categories')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('is_subs');
        });
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('market_categories');
        });
    }
}