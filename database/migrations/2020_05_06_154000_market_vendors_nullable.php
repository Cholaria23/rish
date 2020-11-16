<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketVendorsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_vendors_tmp_pictures', function (Blueprint $table) {
            DB::statement("ALTER TABLE `market_vendors_tmp_pictures` CHANGE `vendor_id` `vendor_id` INT(10) UNSIGNED NULL, CHANGE `vendor_good_id` `vendor_good_id` VARCHAR(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_vendors_tmp_pictures', function (Blueprint $table) {
            DB::statement("ALTER TABLE `market_vendors_tmp_pictures` CHANGE `vendor_id` `vendor_id` INT(10) UNSIGNED NOT NULL, CHANGE `vendor_good_id` `vendor_good_id` VARCHAR(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL; ");
        });
    }
}
