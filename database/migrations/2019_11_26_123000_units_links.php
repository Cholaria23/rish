<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsLinks extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units', function(Blueprint $table) {
            $table->boolean('is_short_unit')->default(0);
            $table->boolean('is_short_link_blank')->default(1);
            $table->string('short_link', 255)->nullable();
        });       
    }

    public function down() {        
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('is_short_unit');
            $table->dropColumn('is_short_link_blank');
            $table->dropColumn('short_link');
        });        
    }
}