<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeoSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $parent_id = DB::table('sections')->where('alias', 'seo')->first()->id;
        $sort_order = DB::table('sections')->where('parent_id', $parent_id)->max('sort_order') + 1;
        DB::table('sections')->insert([
            [
                'parent_id' => $parent_id,
                'sort_order' => $sort_order,
                'alias' => 'seo_search',
                'lang_name' => 'AdminPanel::main.sections.seo_search',
                'route' => 'admin.seo.search',
            ]
        ]);  

        Schema::create('seo_search', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request')->nullable();
            $table->integer('units_result')->default(0);
            $table->integer('units_cats_result')->default(0);
            $table->integer('goods_result')->default(0);
            $table->integer('goods_cats_result')->default(0);
            $table->integer('count')->default(1);
            $table->timestamps();
        });

        Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->text('tags')->nullable();
        }); 

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'seo_search')->delete();
        Schema::dropIfExists('seo_search');

        Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
}
