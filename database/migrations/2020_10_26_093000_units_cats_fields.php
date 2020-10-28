<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsCatsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_categories', function (Blueprint $table) {
            $table->string('cat_fields')->nullable()->default("name,seo,pre_info,post_info,media,chars,params,fields,cat_fields,images_params");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories', function (Blueprint $table) {
            $table->dropColumn('cat_fields');
        });
    }
}
