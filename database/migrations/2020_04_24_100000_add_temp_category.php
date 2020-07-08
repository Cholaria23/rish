<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTempCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('market_categories', function (Blueprint $table) {
            $table->boolean('is_temp')->default(0);
        });

        \Demos\Market\MarketCategoriesController::doAddCategory('root', null, 1);

        DB::table('market_goods_rel_types')->insert([
            'is_undeletable' => 1,
            'name' => 'temp_relation',
                                                    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('market_categories')->where('is_temp', 1)->delete();
        DB::table('market_goods_rel_types')->where('name', 'temp_relation')->delete();

        Schema::table('market_categories', function (Blueprint $table) {
            $table->dropColumn('is_temp');
        });
    }
}