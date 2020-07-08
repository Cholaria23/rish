<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MostViewedGoodsSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('widgets')->where('name', 'favorite_market_categories')->update(['section' => 'market']);
        DB::table('widgets')->where('name', 'last_modified_goods')->update(['section' => 'goods']);
        DB::table('widgets')->where('name', 'most_viewed_goods')->update(['section' => 'goods']);
        //это не нужно роллбекать

        $parent_id = DB::table('sections')->where('alias', 'seo')->first()->id;
        $sort_order = DB::table('sections')->max('sort_order') + 1;


        DB::table('sections')->insert([
            [
                'alias' => 'most_viewed_goods',
                'lang_name' => 'Market::main.sections.most_viewed_goods',
                'route' => 'admin.seo.mostViewedGoods',
                'parent_id' => $parent_id,
                'sort_order' => $sort_order
            ],
        ]);

        DB::table('widgets')->where('name', 'most_viewed_goods')->update(['section' => 'most_viewed_goods']);

        Schema::table('market_goods', function(Blueprint $table){
            $table->dateTime('last_visitor_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods', function(Blueprint $table){
            $table->dropColumn('last_visitor_date');
        });

        DB::table('widgets')->where('name', 'most_viewed_goods')->update(['section' => 'goods']);

        DB::table('sections')->where('alias', 'most_viewed_goods')->delete();
    }
}
