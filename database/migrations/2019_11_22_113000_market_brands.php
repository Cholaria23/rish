<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_params', function(Blueprint $table) {
            $table->string('brands_sort_order')->default('name');
            $table->string('brands_small_aspect_cover', 255)->default('4:3');
            $table->string('brands_thumb_aspect_cover', 255)->default('4:3');
            $table->string('brands_big_width_cover', 255)->default('2000');
            $table->string('brands_small_width_cover', 255)->default('500');
            $table->string('brands_thumb_width_cover', 255)->default('200');
            $table->boolean('brands_is_fill_cover')->default(0);
        });

        DB::table('params')->update(['is_installed' => 0]);

        $parent_id = DB::table('sections')->where('alias', 'market')->first()->id;
        DB::table('sections')->insert([
            [
                'alias' => 'market_brands',
                'lang_name' => 'Market::main.sections.brands',
                'route' => 'admin.market.brands',
                'parent_id' => $parent_id
            ]
        ]);

        Schema::create('market_brands_countries', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
        });

        Schema::create('market_brands_countries_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->nullable()->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
        });

        Schema::table('market_brands_countries_lang', function(Blueprint $table) {
            $table->foreign('country_id', 'market_brands_countries_lang_1')->references('id')->on('market_brands_countries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_brands', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('country_id')->nullable()->unsigned()->index();
            $table->string('alias', 255)->unique();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->string('link', 255)->nullable();
            $table->text('cover_svg')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('cover_img', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_brands', function(Blueprint $table) {
            $table->foreign('country_id', 'market_brands_1')->references('id')->on('market_brands_countries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_brands_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_key', 255)->nullable();
            $table->text('meta_desc')->nullable();
        });

        Schema::table('market_brands_lang', function(Blueprint $table) {
            $table->foreign('brand_id', 'market_brands_lang_1')->references('id')->on('market_brands')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('market_goods', function(Blueprint $table) {
            $table->integer('brand_id')->nullable()->unsigned()->index();
            $table->foreign('brand_id', 'market_goods_brand')->references('id')->on('market_brands')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods', function (Blueprint $table) {
            $table->dropForeign('market_goods_brand');
            $table->dropColumn('brand_id');
        });
        Schema::table('market_brands_lang', function (Blueprint $table) {
            $table->dropForeign('market_brands_lang_1');
        });
        Schema::dropIfExists('market_brands_lang');

        Schema::table('market_brands', function (Blueprint $table) {
            $table->dropForeign('market_brands_1');
        });
        Schema::dropIfExists('market_brands');

        Schema::table('market_brands_countries_lang', function (Blueprint $table) {
            $table->dropForeign('market_brands_countries_lang_1');
        });
        Schema::dropIfExists('market_brands_countries_lang');
        Schema::dropIfExists('market_brands_countries');

        DB::table('sections')->where('alias', 'market_brands')->delete();   

        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('brands_sort_order');
            $table->dropColumn('brands_small_aspect_cover');
            $table->dropColumn('brands_thumb_aspect_cover');
            $table->dropColumn('brands_big_width_cover');
            $table->dropColumn('brands_small_width_cover');
            $table->dropColumn('brands_thumb_width_cover');
            $table->dropColumn('brands_is_fill_cover');
        });
    }
}