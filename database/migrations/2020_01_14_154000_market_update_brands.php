<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketUpdateBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_brands', function(Blueprint $table) {
            $table->boolean('is_top')->default(0);
            $table->integer('unit_id')->nullable()->unsigned()->index();
            $table->string('small_aspect_gallery', 255)->default('4:3');
            $table->string('thumb_aspect_gallery', 255)->default('4:3');
            $table->string('big_width_gallery', 255)->default('2000');
            $table->string('small_width_gallery', 255)->default('500');
            $table->string('thumb_width_gallery', 255)->default('200');
            $table->boolean('is_fill_gallery')->default(0);
        });

        Schema::table('market_brands', function(Blueprint $table) {
            $table->foreign('unit_id', 'market_brands_unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_brands_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->string('poster_src', 255)->nullable();
            $table->string('video_src', 255)->nullable();
            $table->string('video_id', 255)->nullable();
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_autoplay')->default(1);
            $table->boolean('is_controls')->default(1);
            $table->boolean('is_loop')->default(1);
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_brands_videos', function(Blueprint $table) {
            $table->foreign('brand_id', 'market_brands_videos_1')->references('id')->on('market_brands')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_brands_videos_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description_1', 255)->nullable();
            $table->string('description_2', 255)->nullable();
        });

        Schema::table('market_brands_videos_lang', function(Blueprint $table) {
            $table->foreign('video_id', 'market_brands_videos_lang_1')->references('id')->on('market_brands_videos')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_brands_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_brands_groups', function(Blueprint $table) {
            $table->foreign('brand_id', 'market_brands_groups_1')->references('id')->on('market_brands')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_brands_groups_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('description_1')->nullable();
            $table->text('description_2')->nullable();
        });

        Schema::table('market_brands_groups_lang', function(Blueprint $table) {
            $table->foreign('group_id', 'market_brands_groups_lang_1')->references('id')->on('market_brands_groups')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_brands_series', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
            $table->integer('unit_id')->nullable()->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_top')->default(0);
            $table->string('alias', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->text('cover_svg')->nullable();
            $table->string('cover_img', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_brands_series', function(Blueprint $table) {
            $table->foreign('brand_id', 'market_brands_series_1')->references('id')->on('market_brands')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('group_id', 'market_brands_series_2')->references('id')->on('market_brands_groups')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('unit_id', 'market_brands_series_3')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_brands_series_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('series_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('short_desc', 255)->nullable();
            $table->text('long_desc')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_key', 255)->nullable();
            $table->text('meta_desc')->nullable();
        });

        Schema::table('market_brands_series_lang', function(Blueprint $table) {
            $table->foreign('series_id', 'market_brands_series_lang_1')->references('id')->on('market_brands_series')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_brands_series_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('series_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->string('poster_src', 255)->nullable();
            $table->string('video_src', 255)->nullable();
            $table->string('video_id', 255)->nullable();
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_autoplay')->default(1);
            $table->boolean('is_controls')->default(1);
            $table->boolean('is_loop')->default(1);
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_brands_series_videos', function(Blueprint $table) {
            $table->foreign('series_id', 'market_brands_series_videos_1')->references('id')->on('market_brands_series')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_brands_series_videos_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description_1', 255)->nullable();
            $table->string('description_2', 255)->nullable();
        });

        Schema::table('market_brands_series_videos_lang', function(Blueprint $table) {
            $table->foreign('video_id', 'market_brands_series_videos_lang_1')->references('id')->on('market_brands_series_videos')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_brands_series_images', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('series_id')->nullable()->unsigned()->index();
            $table->string('src', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_brands_series_images', function(Blueprint $table) {
            $table->foreign('series_id', 'market_brands_series_images_1')->references('id')->on('market_brands_series')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_brands_series_images_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
        });

        Schema::table('market_brands_series_images_lang', function(Blueprint $table) {
            $table->foreign('image_id', 'market_brands_series_images_lang_1')->references('id')->on('market_brands_series_images')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_brands_series_files', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('series_id')->unsigned()->index();
            $table->integer('file_id')->nullable()->index()->unsigned();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('market_brands_series_files', function(Blueprint $table) {
            $table->foreign('series_id', 'market_brands_series_files_1')->references('id')->on('market_brands_series')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('file_id', 'market_brands_series_files_2')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('market_goods', function(Blueprint $table) {            
            $table->integer('brand_series_id')->nullable()->unsigned()->index();
            $table->integer('brand_group_id')->nullable()->unsigned()->index();
        });
        Schema::table('market_goods', function(Blueprint $table) {
            $table->foreign('brand_series_id', 'market_goods_series_id')->references('id')->on('market_brands_series')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('brand_group_id', 'market_goods_group_id')->references('id')->on('market_brands_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('market_goods', function (Blueprint $table) {
            $table->dropForeign('market_goods_series_id');
            $table->dropForeign('market_goods_group_id');
        });
        Schema::table('market_goods', function(Blueprint $table) {
            $table->dropColumn('brand_series_id');
            $table->dropColumn('brand_group_id');
        });

        Schema::table('market_brands_series_files', function (Blueprint $table) {
            $table->dropForeign('market_brands_series_files_1');
            $table->dropForeign('market_brands_series_files_2');
        });
        Schema::dropIfExists('market_brands_series_files');

        Schema::table('market_brands_series_images_lang', function (Blueprint $table) {
            $table->dropForeign('market_brands_series_images_lang_1');
        });
        Schema::dropIfExists('market_brands_series_images_lang');

        Schema::table('market_brands_series_images', function (Blueprint $table) {
            $table->dropForeign('market_brands_series_images_1');
        });
        Schema::dropIfExists('market_brands_series_images');

        Schema::table('market_brands_series_videos_lang', function (Blueprint $table) {
            $table->dropForeign('market_brands_series_videos_lang_1');
        });
        Schema::table('market_brands_series_videos', function (Blueprint $table) {
            $table->dropForeign('market_brands_series_videos_1');
        });
        Schema::dropIfExists('market_brands_series_videos_lang');
        Schema::dropIfExists('market_brands_series_videos');

        Schema::table('market_brands_series_lang', function (Blueprint $table) {
            $table->dropForeign('market_brands_series_lang_1');
        });

        Schema::table('market_brands_series', function (Blueprint $table) {
            $table->dropForeign('market_brands_series_1');
            $table->dropForeign('market_brands_series_2');
            $table->dropForeign('market_brands_series_3');
        });

        Schema::dropIfExists('market_brands_series_lang');
        Schema::dropIfExists('market_brands_series');

        Schema::table('market_brands_groups_lang', function (Blueprint $table) {
            $table->dropForeign('market_brands_groups_lang_1');
        });
        Schema::table('market_brands_groups', function (Blueprint $table) {
            $table->dropForeign('market_brands_groups_1');
        });
        Schema::dropIfExists('market_brands_groups_lang');
        Schema::dropIfExists('market_brands_groups');

        Schema::table('market_brands_videos_lang', function (Blueprint $table) {
            $table->dropForeign('market_brands_videos_lang_1');
        });
        Schema::table('market_brands_videos', function (Blueprint $table) {
            $table->dropForeign('market_brands_videos_1');
        });
        Schema::dropIfExists('market_brands_videos_lang');
        Schema::dropIfExists('market_brands_videos');

        Schema::table('market_brands', function (Blueprint $table) {
            $table->dropForeign('market_brands_unit_id');
        });

        Schema::table('market_brands', function(Blueprint $table) {
            $table->dropColumn('is_top');
            $table->dropColumn('unit_id');
            $table->dropColumn('small_aspect_gallery');
            $table->dropColumn('thumb_aspect_gallery');
            $table->dropColumn('big_width_gallery');
            $table->dropColumn('small_width_gallery');
            $table->dropColumn('thumb_width_gallery');
            $table->dropColumn('is_fill_gallery');
        });
    }
}