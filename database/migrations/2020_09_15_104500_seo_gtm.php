<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeoGtm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('seo', function(Blueprint $table) {
            $table->text('google_tm_start')->nullable();
            $table->text('google_tm_start_home')->nullable();
            $table->text('google_tm_end')->nullable();
            $table->text('google_tm_end_home')->nullable();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('seo', function(Blueprint $table) {
            $table->dropColumn('google_tm_start');
            $table->dropColumn('google_tm_start_home');
            $table->dropColumn('google_tm_end');
            $table->dropColumn('google_tm_end_home');
        });
    }
}