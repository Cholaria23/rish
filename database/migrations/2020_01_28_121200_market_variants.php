<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketVariants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_goods', function (Blueprint $table) {
            $table->integer('parent_id')->nullable()->unsigned()->index();
            $table->foreign('parent_id', 'market_goods_parent_id')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('market_chars_categories', function (Blueprint $table) {
            $table->boolean('is_variant')->default(0);
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods', function (Blueprint $table) {
            $table->dropForeign('market_goods_parent_id');
            $table->dropColumn('parent_id');
        });

        Schema::table('market_chars_categories', function (Blueprint $table) {
            $table->dropColumn('is_variant');
        });
      
    }
}