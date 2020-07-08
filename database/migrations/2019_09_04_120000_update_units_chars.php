<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUnitsChars extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('units_chars_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255)->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('units_chars_groups_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
        });

        Schema::table('units_chars_groups_lang', function(Blueprint $table) {
            $table->foreign('group_id', 'units_chars_groups_lang_1')->references('id')->on('units_chars_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('units_chars_groups')->insert(
            [
                'alias' => "default",
            ]
        );

        DB::table('units_chars_groups_lang')->insert([
            [
                'group_id' => 1,
                'lang' => "ru",
                'name' => "Нераспределенные характеристики",
                'description' => "Неудаляемая группа по умолчанию",
            ],
            [
                'group_id' => 1,
                'lang' => "uk",
                'name' => "Нерозподілені характеристики",
                'description' => "Видаляються група за замовчуванням",
            ],
            [
                'group_id' => 1,
                'lang' => "en",
                'name' => "Unallocated Characteristics",
                'description' => "Default undeletable group",
            ],
        ]);

        Schema::create('units_chars_groups_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('units_chars_groups_categories', function(Blueprint $table) {
            $table->foreign('group_id', 'units_chars_groups_categories_1')->references('id')->on('units_chars_groups')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('cat_id', 'units_chars_groups_categories_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::table('units_chars', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->index()->default(1);
            $table->string('add_name', 255)->nullable();
        });

        Schema::table('units_chars', function(Blueprint $table) {
            $table->foreign('group_id', 'units_chars_1')->references('id')->on('units_chars_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('units_chars_vals', function (Blueprint $table) {
            $table->text('icon_svg')->nullable();
            $table->string('icon_img', 255)->nullable();
        });

        Schema::table('units_chars_vals_lang', function (Blueprint $table) {
            $table->text('description')->nullable();
        });

        Schema::create('units_chars_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('char_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
            $table->boolean('is_char')->default(0);
            $table->boolean('is_filter')->default(0);
            $table->boolean('is_in_list')->default(0);
            $table->integer('sort_order')->default(0);
        });

        Schema::table('units_chars_categories', function(Blueprint $table) {
            $table->foreign('char_id', 'units_chars_categories_1')->references('id')->on('units_chars')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('cat_id', 'units_chars_categories_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });
    }

    public function down() {
        Schema::table('units_chars_categories', function (Blueprint $table) {
            $table->dropForeign('units_chars_categories_1');
            $table->dropForeign('units_chars_categories_2');
        });
        Schema::dropIfExists('units_chars_categories');
        Schema::table('units_chars_vals_lang', function (Blueprint $table) {
            $table->dropColumn('description');
        });
        Schema::table('units_chars_vals', function (Blueprint $table) {
            $table->dropColumn('icon_svg');
            $table->dropColumn('icon_img');
        });
        Schema::table('units_chars', function (Blueprint $table) {
            $table->dropForeign('units_chars_1');
            $table->dropColumn('group_id');
            $table->dropColumn('add_name');
        });

        Schema::table('units_chars_groups_categories', function (Blueprint $table) {
            $table->dropForeign('units_chars_groups_categories_1');
            $table->dropForeign('units_chars_groups_categories_2');
        });
        Schema::dropIfExists('units_chars_groups_categories'); 

        Schema::table('units_chars_groups_lang', function (Blueprint $table) {
            $table->dropForeign('units_chars_groups_lang_1');
        });
        Schema::dropIfExists('units_chars_groups_lang');
        Schema::dropIfExists('units_chars_groups');
    }
}