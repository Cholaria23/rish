<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsVideos extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {       

        Schema::create('market_goods_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
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

        Schema::table('market_goods_videos', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_videos_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_goods_videos_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description_1', 255)->nullable();
            $table->string('description_2', 255)->nullable();
        });

        Schema::table('market_goods_videos_lang', function(Blueprint $table) {
            $table->foreign('video_id', 'market_goods_videos_lang_1')->references('id')->on('market_goods_videos')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_videos_lang', function (Blueprint $table) {
            $table->dropForeign('market_goods_videos_lang_1');
        });

        Schema::table('market_goods_videos', function (Blueprint $table) {
            $table->dropForeign('market_goods_videos_1');
        });
        Schema::dropIfExists('market_goods_videos_lang');
        Schema::dropIfExists('market_goods_videos');       
    }
}
