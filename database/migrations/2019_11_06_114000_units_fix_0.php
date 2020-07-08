<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsFix0 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('units_categories', function(Blueprint $table) {
            $table->boolean('is_hidden_menu')->default(0);
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories', function (Blueprint $table) {
            $table->dropColumn('is_hidden_menu');
        });        
    }
}