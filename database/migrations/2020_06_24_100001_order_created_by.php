<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderCreatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders', function(Blueprint $table){
            $table->unsignedInteger('created_by')->nullable();

            $table->foreign('created_by', 'market_orders_created_by_ibfk')->references('id')->on('accounts')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders', function(Blueprint $table){
            $table->dropForeign('market_orders_created_by_ibfk');

            $table->dropColumn('created_by');
        });
    }
}
