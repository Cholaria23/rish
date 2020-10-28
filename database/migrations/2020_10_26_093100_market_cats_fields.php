<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketCatsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_categories', function (Blueprint $table) {
            $table->string('cat_fields')->nullable()->default("name,seo,pre_info,post_info,media,files,params,chars,fields,images_params,cat_fields");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('cat_fields');
        });
    }
}
