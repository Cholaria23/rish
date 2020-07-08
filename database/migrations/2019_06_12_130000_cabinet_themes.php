<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CabinetThemes extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('accounts', function(Blueprint $table) {
            $table->string('theme', 255)->default('default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {        
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('theme');
        });        
    }
}
