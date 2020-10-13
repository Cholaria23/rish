<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketCharsSpecOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_chars', function(Blueprint $table) {
            $table->boolean('spec_option_1')->default(0);
            $table->boolean('spec_option_2')->default(0);
            $table->boolean('spec_option_3')->default(0);
        });

        Schema::table('market_params', function (Blueprint $table) {
            $table->string('market_char_spec_option_1_name', 255)->nullable();
            $table->string('market_char_spec_option_2_name', 255)->nullable();
            $table->string('market_char_spec_option_3_name', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_chars', function (Blueprint $table) {
            $table->dropColumn('spec_option_1');
            $table->dropColumn('spec_option_2');
            $table->dropColumn('spec_option_3');
        });
        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('market_char_spec_option_1_name');
            $table->dropColumn('market_char_spec_option_2_name');
            $table->dropColumn('market_char_spec_option_3_name');
        });
    }
}
