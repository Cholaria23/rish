<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuConstructor extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('sections')->insert([
            [
                'alias' => 'menu_items',
                'lang_name' => 'AdminPanel::main.sections.menu_items',
                'route' => 'admin.menu_items.index',
            ]
        ]);

        Schema::create('menu', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('new');
            $table->softDeletes();
        });

        \DB::table('menu')->insert([
            [
                'name' => 'Меню 1',
            ],
            [
                'name' => 'Меню 2',
            ],
        ]);

        Schema::create('menu_items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->nullable()->index()->unsigned();
            $table->integer('parent_id')->nullable()->index()->unsigned();
            $table->integer('sort_order')->default(0);
            $table->string('type')->default('self');
            $table->string('href')->nullable();
            $table->string('image')->nullable();
            $table->string('svg')->nullable();
            $table->integer('is_hidden')->default(1);
            $table->integer('units_cat_id')->nullable()->unsigned()->index();
            $table->integer('unit_id')->nullable()->unsigned()->index();
            $table->boolean('is_blank')->default(0);
            $table->boolean('is_href')->default(1);
        });
        Schema::table('menu_items', function (Blueprint $table) {
            $table->foreign('menu_id', 'menu_items_ifbk_1')->references('id')->on('menu')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('parent_id', 'menu_items_ifbk_2')->references('id')->on('menu_items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('units_cat_id', 'menu_items_ifbk_3')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('unit_id', 'menu_items_ifbk_4')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');            
        });

        Schema::create('menu_items_lang', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
        });     

        Schema::table('menu_items_lang', function (Blueprint $table) {
            $table->foreign('item_id', 'menu_items_lang_ifbk_1')->references('id')->on('menu_items')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('menu_items_lang', function (Blueprint $table) {
            $table->dropForeign( 'menu_items_lang_ifbk_1');
        });
        Schema::dropIfExists('menu_items_lang');

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign( 'menu_items_ifbk_1');
            $table->dropForeign( 'menu_items_ifbk_2');
            $table->dropForeign( 'menu_items_ifbk_3');
            $table->dropForeign( 'menu_items_ifbk_4');
        });
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menu');

        DB::table('sections')->where('alias', 'menu_items')->delete();
    }
}
