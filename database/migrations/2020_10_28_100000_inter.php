<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inter extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('sections')->insert([
            [
                'alias' => 'interactive_images',
                'lang_name' => 'AdminPanel::main.sections.interactive_images',
                'route' => 'admin.interactive_images.index',
            ]
        ]);  
        Schema::create('interactive_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unit_id')->nullable();
            $table->boolean('is_hidden')->default(1); 
            $table->integer('sort_order')->default(0);
            $table->string('img', 255)->nullable();
        });

        Schema::table('interactive_images', function (Blueprint $table) {
            $table->foreign('unit_id', 'interactive_images_unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('interactive_images_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inter_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
        });

        Schema::table('interactive_images_lang', function (Blueprint $table) {
            $table->foreign('inter_id', 'interactive_images_lang_inter_id')->references('id')->on('interactive_images')->onUpdate('CASCADE')->onDelete('CASCADE');
        });


        Schema::create('interactive_images_dots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inter_id')->unsigned()->index();
            $table->string('x_pixel', 255)->nullable();
            $table->string('y_pixel', 255)->nullable();
            $table->string('x_percent', 255)->nullable();
            $table->string('y_percent', 255)->nullable();
            $table->boolean('is_hidden')->default(1); 
            $table->boolean('is_blank')->default(1); 
            $table->string('href', 255)->nullable();
        });

        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->foreign('inter_id', 'interactive_images_dots_inter_id')->references('id')->on('interactive_images')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('interactive_images_dots_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dot_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->string('anchor', 255)->nullable();
        });

        Schema::table('interactive_images_dots_lang', function (Blueprint $table) {
            $table->foreign('dot_id', 'interactive_images_dots_lang_inter_id')->references('id')->on('interactive_images_dots')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('interactive_images_dots_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dot_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('interactive_images_dots_units', function (Blueprint $table) {
            $table->foreign('dot_id', 'interactive_images_dots_units_unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('dot_id', 'interactive_images_dots_units_dot_id')->references('id')->on('interactive_images_dots')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('interactive_images_dots_units', function (Blueprint $table) {
            $table->dropForeign( 'interactive_images_dots_units_unit_id');
            $table->dropForeign( 'interactive_images_dots_units_dot_id');
        });
        Schema::dropIfExists('interactive_images_dots_units');

        Schema::table('interactive_images_dots_lang', function (Blueprint $table) {
            $table->dropForeign( 'interactive_images_dots_lang_inter_id');
        });
        Schema::dropIfExists('interactive_images_dots_lang');

        Schema::table('interactive_images_dots', function (Blueprint $table) {
            $table->dropForeign( 'interactive_images_dots_inter_id');
        });
        Schema::dropIfExists('interactive_images_dots');

        Schema::table('interactive_images_lang', function (Blueprint $table) {
            $table->dropForeign( 'interactive_images_lang_inter_id');
        });
        Schema::dropIfExists('interactive_images_lang');

        Schema::table('interactive_images', function (Blueprint $table) {
            $table->dropForeign( 'interactive_images_unit_id');
        });
        Schema::dropIfExists('interactive_images');

        DB::table('sections')->where('alias', 'interactive_images')->delete();
    }
}
