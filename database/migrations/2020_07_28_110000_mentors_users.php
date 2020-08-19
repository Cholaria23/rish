<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MentorsUsers extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('specialists', function(Blueprint $table){
            $table->integer('user_id')->nullable()->index()->unsigned();
            $table->boolean('is_autor')->default(0);
            $table->boolean('is_consultant')->default(0);
        });

        Schema::table('specialists', function(Blueprint $table) {
            $table->foreign('user_id', 'specialists_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists', function (Blueprint $table) {
            $table->dropForeign('specialists_1');
        });
        
        Schema::table('specialists', function(Blueprint $table){
            $table->dropColumn('user_id');
            $table->dropColumn('is_autor');
            $table->dropColumn('is_consultant');
        });
    }
}
