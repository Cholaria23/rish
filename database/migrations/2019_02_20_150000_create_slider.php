<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('sections')->insert([
            [
                'alias' => 'slider',
                'lang_name' => 'AdminPanel::main.sections.slider',
                'route' => 'admin.slider.index',
            ]
        ]);  

        Schema::create('slider', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_auto')->default(1); 
            $table->boolean('is_random')->default(0); 
            $table->integer('timeout')->default(3);
        });

        DB::table('slider')->insert([
            [
            	'is_auto' => 1,
            	'is_random' => 0,
            	'timeout' => 3,
            ]
        ]);

        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1); 
            $table->string('img_desktop', 255)->nullable();
            $table->string('img_mobile', 255)->nullable();
            $table->string('video', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->string('href_1', 255)->nullable();
            $table->string('href_2', 255)->nullable();
            $table->string('data_attr_1', 255)->nullable();
            $table->string('data_attr_2', 255)->nullable();
            $table->boolean('is_blank_1')->default(1); 
            $table->boolean('is_blank_2')->default(1);
            $table->integer('title_color_id')->unsigned()->nullable();
            $table->integer('text_color_id')->unsigned()->nullable();
            $table->integer('mask_color_id')->unsigned()->nullable();
            $table->string('mask_opacity', 2)->nullable()->default(0);
            $table->integer('position')->nullable()->default(5);
            $table->integer('hor_margin')->nullable()->default(0);
            $table->integer('vert_margin')->nullable()->default(0);
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->boolean('is_period')->default(0); 
            $table->timestamps(); 
        });

        Schema::table('slides', function(Blueprint $table) {
            $table->foreign('title_color_id', 'slides_1')->references('id')->on('brandbook_colors');
            $table->foreign('text_color_id', 'slides_2')->references('id')->on('brandbook_colors');
            $table->foreign('mask_color_id', 'slides_3')->references('id')->on('brandbook_colors');
        });

        Schema::create('slides_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slide_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('title', 255)->nullable();
            $table->text('text')->nullable();
            $table->string('button_1_caption', 255)->nullable();
            $table->string('button_2_caption', 255)->nullable();
        });

        Schema::table('slides_lang', function(Blueprint $table) {
            $table->foreign('slide_id', 'slides_lang_1')->references('id')->on('slides')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'slider')->delete();

        Schema::table('slides_lang', function (Blueprint $table) {
            $table->dropForeign('slides_lang_1');
        });

        Schema::table('slides', function (Blueprint $table) {
            $table->dropForeign('slides_1');
            $table->dropForeign('slides_2');
            $table->dropForeign('slides_3');
        });

        Schema::dropIfExists('slider');
        Schema::dropIfExists('slides_lang');
        Schema::dropIfExists('slides');
    }
}
