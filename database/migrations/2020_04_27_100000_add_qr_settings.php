<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQrSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('market_params', function (Blueprint $table) {
            $table->integer('qr_count_at_line')->default(6);
            $table->boolean('qr_is_show_name')->default(0);
            $table->boolean('qr_is_show_article')->default(0);
            $table->boolean('qr_is_show_price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('qr_count_at_line', 'qr_is_show_name', 'qr_is_show_article', 'qr_is_show_price');
        });
    }
}