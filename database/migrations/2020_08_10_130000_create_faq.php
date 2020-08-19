<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaq extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        DB::table('sections')->insert([
            [
                'alias' => 'faq',
                'lang_name' => 'AdminPanel::main.sections.faq',
                'route' => 'admin.faq.index',
            ]
        ]);

        Schema::create('faq_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('faq_groups_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
        });

        Schema::table('faq_groups_lang', function(Blueprint $table) {
            $table->foreign('group_id', 'faq_groups_lang_1')->references('id')->on('faq_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('faq', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('faq', function(Blueprint $table) {
            $table->foreign('group_id', 'faq_1')->references('id')->on('faq_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('faq_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faq_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->text('link')->nullable();
        });

        Schema::table('faq_lang', function(Blueprint $table) {
            $table->foreign('faq_id', 'faq_lang_1')->references('id')->on('faq')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('faq_units_relations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('sort_order')->default(0);
            $table->integer('faq_group_id')->unsigned()->index();
            $table->integer('unit_id')->nullable()->index()->unsigned();
        });

        Schema::table('faq_units_relations', function(Blueprint $table) {
            $table->foreign('faq_group_id', 'faq_units_relations_1')->references('id')->on('faq_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('unit_id', 'faq_units_relations_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });        

        Schema::create('faq_units_cats_relations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('sort_order')->default(0);
            $table->integer('faq_group_id')->unsigned()->index();
            $table->integer('cat_id')->nullable()->index()->unsigned();
        });

        Schema::table('faq_units_cats_relations', function(Blueprint $table) {
            $table->foreign('faq_group_id', 'faq_units_cats_relations_1')->references('id')->on('faq_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'faq_units_cats_relations_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        if (class_exists(\Demos\Market\MarketServiceProvider::class)) {

            Schema::create('faq_goods_relations', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('sort_order')->default(0);
                $table->integer('faq_group_id')->unsigned()->index();
                $table->integer('good_id')->nullable()->index()->unsigned();
            });

            Schema::table('faq_goods_relations', function(Blueprint $table) {
                $table->foreign('faq_group_id', 'faq_goods_relations_1')->references('id')->on('faq_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign('good_id', 'faq_goods_relations_2')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            });

            Schema::create('faq_market_cats_relations', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('sort_order')->default(0);
                $table->integer('faq_group_id')->unsigned()->index();
                $table->integer('cat_id')->nullable()->index()->unsigned();
            });

            Schema::table('faq_market_cats_relations', function(Blueprint $table) {
                $table->foreign('faq_group_id', 'faq_market_cats_relations_1')->references('id')->on('faq_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign('cat_id', 'faq_market_cats_relations_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            });
        }        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {        

        if (class_exists(\Demos\Market\MarketServiceProvider::class)) {
            Schema::table('faq_market_cats_relations', function (Blueprint $table) {
                $table->dropForeign('faq_market_cats_relations_1');
                $table->dropForeign('faq_market_cats_relations_2');
            });
            Schema::dropIfExists('faq_market_cats_relations');

            Schema::table('faq_goods_relations', function (Blueprint $table) {
                $table->dropForeign('faq_goods_relations_1');
                $table->dropForeign('faq_goods_relations_2');
            });
            Schema::dropIfExists('faq_goods_relations');
        }

        Schema::table('faq_units_cats_relations', function (Blueprint $table) {
            $table->dropForeign('faq_units_cats_relations_1');
            $table->dropForeign('faq_units_cats_relations_2');
        });
        Schema::dropIfExists('faq_units_cats_relations');

        Schema::table('faq_units_relations', function (Blueprint $table) {
            $table->dropForeign('faq_units_relations_1');
            $table->dropForeign('faq_units_relations_2');
        });
        Schema::dropIfExists('faq_units_relations');


        Schema::table('faq_lang', function (Blueprint $table) {
            $table->dropForeign('faq_lang_1');
        });
        Schema::dropIfExists('faq_lang');

        Schema::table('faq', function (Blueprint $table) {
            $table->dropForeign('faq_1');
        });
        Schema::dropIfExists('faq');

        Schema::table('faq_groups_lang', function (Blueprint $table) {
            $table->dropForeign('faq_groups_lang_1');
        });
        Schema::dropIfExists('faq_groups_lang');
        Schema::dropIfExists('faq_groups');

        DB::table('sections')->whereIn('alias', ['faq'])->delete();
    }
}
