<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MostViewedUnitsSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('sections')->where('alias', 'seo')->update(['route' => 'admin.seo.parent']);
        $parent_id = DB::table('sections')->where('alias', 'seo')->first()->id;
        $sort_order = DB::table('sections')->max('sort_order') + 1;

        DB::table('sections')->insert([
            [
                'alias' => 'seo_index',
                'lang_name' => 'AdminPanel::main.sections.seo',
                'route' => 'admin.seo.index',
                'parent_id' => $parent_id,
                'sort_order' => $sort_order
            ],
            [
                'alias' => 'most_viewed_units',
                'lang_name' => 'AdminPanel::main.sections.most_viewed_units',
                'route' => 'admin.seo.mostViewedUnits',
                'parent_id' => $parent_id,
                'sort_order' => $sort_order + 1
            ],
        ]);

        DB::table('widgets')->where('name', 'most_viewed_units')->update(['section' => 'most_viewed_units']);

        $seo_index_id = DB::table('sections')->where('alias', 'seo_index')->first()->id;

        $insert_arr = [];

        $exist_accesses = DB::table('sections_accounts')->where('section_id', $parent_id)->get();

        foreach($exist_accesses as $access){
            $insert_arr[] = [
                'account_id' => $access->account_id,
                'section_id' => $seo_index_id,
                'access_type' => 'edit'
            ];
        }

        DB::table('sections_accounts')->insert($insert_arr);

        Schema::table('units', function(Blueprint $table){
            $table->dateTime('last_visitor_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units', function(Blueprint $table){
            $table->dropColumn('last_visitor_date');
        });

        DB::table('widgets')->where('name', 'most_viewed_units')->update(['section' => 'units']);

        DB::table('sections')->whereIn('alias', ['seo_index', 'most_viewed_units'])->delete();
    }
}
