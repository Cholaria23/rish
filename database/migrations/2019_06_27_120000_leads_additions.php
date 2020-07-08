<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeadsAdditions extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('youtube_video_id', 255)->nullable();
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
        });

        Schema::create('leads_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id')->unsigned()->index()->nullable();
            $table->string('type', 255)->default('file');
            $table->boolean('is_hidden')->default(1);
            $table->string('url', 255)->nullable();
        });        

        Schema::table('leads_files', function(Blueprint $table) {
            $table->foreign('lead_id', 'leads_files_1')->references('id')->on('leads')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });
    }

    public function down() {
        Schema::table('leads_files', function (Blueprint $table) {
            $table->dropForeign('leads_files_1');
        });        
        Schema::dropIfExists('leads_files');

        Schema::table('leads', function (Blueprint $table){
            $table->dropColumn('youtube_video_id');
            $table->dropColumn('likes');
            $table->dropColumn('dislikes');
        });
    }
}