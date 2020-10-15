<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketLongDescTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function (Blueprint $table) {
            $table->boolean('is_goods_text_only_templates')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('is_goods_text_only_templates');
        });
    }
}
