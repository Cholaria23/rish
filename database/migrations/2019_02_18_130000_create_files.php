<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('sections')->insert([
            [
                'alias' => 'files',
                'lang_name' => 'AdminPanel::main.sections.files',
                'route' => 'admin.files.index',
            ]
        ]);  

        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('src', 255)->nullable();
            $table->string('extention', 255)->nullable();
            $table->boolean('is_hidden')->default(1); 
            $table->integer('sort_order')->default(0);
            $table->string('password', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('files_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
        });

        Schema::table('files_lang', function(Blueprint $table) {
            $table->foreign('file_id', 'files_lang_1')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('brandbook_icons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('extention', 255)->nullable();
            $table->string('icon_src', 255)->nullable();
            $table->text('svg', 255)->nullable();
        });

        DB::table('brandbook_icons')->insert([
            ['extention' => "docx", 'icon_src' => "docx.png", 'svg' => ""],
            ['extention' => "pdf", 'icon_src' => "pdf.png", 'svg' => ""],
            ['extention' => "pptx", 'icon_src' => "pptx.png", 'svg' => ""],
            ['extention' => "xlsx", 'icon_src' => "xlsx.png", 'svg' => ""]
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('files_lang', function (Blueprint $table) {
            $table->dropForeign('files_lang_1');
        });

        DB::table('sections')->where('alias', 'files')->delete();
        Schema::dropIfExists('files_lang');
        Schema::dropIfExists('files');
        Schema::dropIfExists('brandbook_icons');
    }
}
