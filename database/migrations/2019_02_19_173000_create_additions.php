<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditions extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('additions_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255)->unique();
            $table->string('package', 255)->default("default");
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_expandable')->default(1);
            $table->boolean('is_solo')->default(1);
            $table->integer('sort_order')->default(0);
            $table->text('default_children')->nullable();            
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('additions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index()->nullable();
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_wide')->default(1);
            $table->boolean('is_spoiler')->default(0);
            $table->string('title_type', 255)->default("h1");
            $table->integer('title_color_id')->unsigned()->nullable();
            $table->integer('text_color_id')->unsigned()->nullable();
            $table->integer('theme_id')->unsigned()->default(1)->index();
            $table->softDeletes();
            $table->timestamps();      
        });

        Schema::table('additions', function(Blueprint $table) {
            $table->foreign('type_id', 'additions_1')->references('id')->on('additions_types')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('unit_id', 'additions_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('parent_id', 'additions_3')->references('id')->on('additions')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('theme_id', 'additions_4')->references('id')->on('brandbook_themes');
            $table->foreign('title_color_id', 'additions_5')->references('id')->on('brandbook_colors');
            $table->foreign('text_color_id', 'additions_6')->references('id')->on('brandbook_colors');
        });

        Schema::create('additions_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->string('name', 255)->nullable();         
            $table->string('data_type', 255)->nullable();         
        });

        Schema::table('additions_fields', function(Blueprint $table) {
            $table->foreign('type_id', 'additions_fields_1')->references('id')->on('additions_types')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('additions_fields_values', function (Blueprint $table) {
            $table->increments('id');    
            $table->integer('type_id')->unsigned()->index();
            $table->integer('addition_id')->unsigned()->index();
            $table->integer('field_id')->unsigned()->index();
            $table->text('value')->nullable();  
        });

        Schema::table('additions_fields_values', function(Blueprint $table) {
            $table->foreign('type_id', 'additions_fields_values_1')->references('id')->on('additions_types')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('addition_id', 'additions_fields_values_2')->references('id')->on('additions')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('field_id', 'additions_fields_values_3')->references('id')->on('additions_fields')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('additions_lang_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->string('name', 255)->nullable();         
            $table->string('data_type', 255)->nullable();         
        });

        Schema::table('additions_lang_fields', function(Blueprint $table) {
            $table->foreign('type_id', 'additions_lang_fields_1')->references('id')->on('additions_types')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('additions_lang_fields_values', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('lang', 2)->default('ru');   
            $table->integer('type_id')->unsigned()->index();
            $table->integer('addition_id')->unsigned()->index();
            $table->integer('field_id')->unsigned()->index();
            $table->text('value')->nullable();  
        });

        Schema::table('additions_lang_fields_values', function(Blueprint $table) {
            $table->foreign('type_id', 'additions_lang_fields_values_1')->references('id')->on('additions_types')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('addition_id', 'additions_lang_fields_values_2')->references('id')->on('additions')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('field_id', 'additions_lang_fields_values_3')->references('id')->on('additions_lang_fields')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('additions_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('addition_id')->unsigned()->index();
            $table->integer('file_id')->nullable()->index()->unsigned();
            $table->integer('sort_order')->default(0);
            $table->softDeletes();
            $table->timestamps();    
        });

        Schema::table('additions_files', function(Blueprint $table) {
            $table->foreign('addition_id', 'additions_files_1')->references('id')->on('additions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('file_id', 'additions_files_2')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('CASCADE');
        });


        DB::table('additions_types')->insert([
            ['alias' => "multicol_content", 'package' => "default", 'is_hidden' => 0, 'is_expandable' => 1,'is_solo' => 1, 'sort_order' => 0, 'default_children' => "multicol_content_item"],
            ['alias' => "multicol_content_item", 'package' => "default", 'is_hidden' => 0, 'is_expandable' => 0,'is_solo' => 0, 'sort_order' => 0, 'default_children' => NULL],
            ['alias' => "plain_text", 'package' => "default", 'is_hidden' => 0, 'is_expandable' => 0,'is_solo' => 1, 'sort_order' => 1, 'default_children' => NULL],
            ['alias' => "big_image", 'package' => "default", 'is_hidden' => 0, 'is_expandable' => 0,'is_solo' => 1, 'sort_order' => 2, 'default_children' => NULL],
        ]);

        $type_id = DB::table('additions_types')->where('alias', 'multicol_content')->first()->id;
        DB::table('additions_lang_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "title", 'data_type' => "varchar"],
        ]);

        $type_id = DB::table('additions_types')->where('alias', 'multicol_content_item')->first()->id;
        DB::table('additions_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "content_type", 'data_type' => "content_type_select"],
            ['type_id' => $type_id, 'sort_order' => 1, 'name' => "youtube_url", 'data_type' => "varchar"],
            ['type_id' => $type_id, 'sort_order' => 2, 'name' => "video_file", 'data_type' => "video"],
            ['type_id' => $type_id, 'sort_order' => 3, 'name' => "image_file", 'data_type' => "image"],
        ]);
        DB::table('additions_lang_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "title", 'data_type' => "varchar"],
            ['type_id' => $type_id, 'sort_order' => 1, 'name' => "text", 'data_type' => "text"],
        ]);

        $type_id = DB::table('additions_types')->where('alias', 'plain_text')->first()->id;
        DB::table('additions_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "column_count", 'data_type' => "varchar"],
        ]);
        DB::table('additions_lang_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "title", 'data_type' => "varchar"],
            ['type_id' => $type_id, 'sort_order' => 1, 'name' => "text", 'data_type' => "text"],
        ]);

        $type_id = DB::table('additions_types')->where('alias', 'big_image')->first()->id;
        DB::table('additions_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "image_desktop_file", 'data_type' => "image"],
            ['type_id' => $type_id, 'sort_order' => 1, 'name' => "image_mobile_file", 'data_type' => "image"],
        ]);
        DB::table('additions_lang_fields')->insert([
            ['type_id' => $type_id, 'sort_order' => 0, 'name' => "title", 'data_type' => "varchar"],
            ['type_id' => $type_id, 'sort_order' => 1, 'name' => "text", 'data_type' => "text"],
        ]);      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('additions_files', function (Blueprint $table) {
            $table->dropForeign('additions_files_1');
            $table->dropForeign('additions_files_2');
        });

        Schema::table('additions_fields_values', function (Blueprint $table) {
            $table->dropForeign('additions_fields_values_1');
            $table->dropForeign('additions_fields_values_2');
            $table->dropForeign('additions_fields_values_3');
        });

        Schema::table('additions_fields', function (Blueprint $table) {
            $table->dropForeign('additions_fields_1');
        });

        Schema::table('additions_lang_fields_values', function (Blueprint $table) {
            $table->dropForeign('additions_lang_fields_values_1');
            $table->dropForeign('additions_lang_fields_values_2');
            $table->dropForeign('additions_lang_fields_values_3');
        });

        Schema::table('additions_lang_fields', function (Blueprint $table) {
            $table->dropForeign('additions_lang_fields_1');
        });

        Schema::table('additions', function (Blueprint $table) {
            $table->dropForeign('additions_1');
            $table->dropForeign('additions_2');
            $table->dropForeign('additions_3');
        });

        Schema::dropIfExists('additions_files');
        Schema::dropIfExists('additions_lang_fields_values');
        Schema::dropIfExists('additions_lang_fields');
        Schema::dropIfExists('additions_fields_values');
        Schema::dropIfExists('additions_fields');
        Schema::dropIfExists('additions');
        Schema::dropIfExists('additions_types');
    }
}
