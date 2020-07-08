<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsDatePublication extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units', function(Blueprint $table) {
            $table->dateTime('date_publication')->nullable();
        });       
    }

    public function down() {        
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('date_publication');
        });        
    }
}