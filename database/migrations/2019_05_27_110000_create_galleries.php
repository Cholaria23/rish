<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleries extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        DB::table('sections')->insert([
            [
                'alias' => 'galleries',
                'lang_name' => 'AdminPanel::main.sections.galleries',
                'route' => 'admin.galleries.index',
            ]
        ]);

        DB::table('sections')->where('alias', 'units_galleries')->delete();

        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->integer('cover_id')->nullable()->index()->unsigned();
            $table->string('small_aspect', 255)->default('4:3');
            $table->string('thumb_aspect', 255)->default('4:3');
            $table->string('big_width', 255)->default('2000');
            $table->string('small_width', 255)->default('500');
            $table->string('thumb_width', 255)->default('200');
            $table->boolean('is_fill')->default(0);
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('galleries_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->text('name')->nullable();
            $table->text('description')->nullable();
        });

        Schema::table('galleries_lang', function(Blueprint $table) {
            $table->foreign('gallery_id', 'galleries_lang_1')->references('id')->on('galleries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('galleries_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('gallery_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('galleries_units', function(Blueprint $table) {
            $table->foreign('unit_id', 'galleries_units_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('gallery_id', 'galleries_units_2')->references('id')->on('galleries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('galleries_photos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned()->index();
            $table->string('file')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->timestamps();
        });

        Schema::table('galleries_photos', function(Blueprint $table) {
            $table->foreign('gallery_id', 'galleries_photos_1')->references('id')->on('galleries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('galleries_photos_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('photo_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->text('title')->nullable();
            $table->text('alt')->nullable();
        });

        Schema::table('galleries_photos_lang', function(Blueprint $table) {
            $table->foreign('photo_id', 'galleries_photos_lang_1')->references('id')->on('galleries_photos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('galleries', function(Blueprint $table) {
            $table->foreign('cover_id', 'galleries_1')->references('id')->on('galleries_photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {        
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropForeign('galleries_1');
        });
        Schema::table('galleries_photos_lang', function (Blueprint $table) {
            $table->dropForeign('galleries_photos_lang_1');
        });
        Schema::table('galleries_photos', function (Blueprint $table) {
            $table->dropForeign('galleries_photos_1');
        });
        Schema::drop('galleries_photos_lang');
        Schema::drop('galleries_photos');
        Schema::table('galleries_units', function (Blueprint $table) {
            $table->dropForeign('galleries_units_1');
            $table->dropForeign('galleries_units_2');
        });
        Schema::drop('galleries_units');
        Schema::table('galleries_lang', function (Blueprint $table) {
            $table->dropForeign('galleries_lang_1');
        });
        Schema::drop('galleries_lang');
        Schema::drop('galleries');
        DB::table('sections')->where('alias', 'galleries')->delete();
    }
}
