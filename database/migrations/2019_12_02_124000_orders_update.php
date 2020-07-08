<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {


        Schema::table('market_orders', function(Blueprint $table) {
            $table->string('post_number', 255)->nullable(); 
            $table->string('city', 255)->nullable(); 
            $table->string('street', 255)->nullable(); 
            $table->string('building', 255)->nullable(); 
            $table->string('room', 255)->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropColumn('post_number');
            $table->dropColumn('city');
            $table->dropColumn('street');
            $table->dropColumn('building');
            $table->dropColumn('room');
        });
        
    }
}