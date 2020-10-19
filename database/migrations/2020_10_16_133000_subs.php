<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_categories', function (Blueprint $table) {
            $table->boolean('is_subs')->default(0);
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->text('units_categories')->nullable();
        });

        Schema::table('subscriptions', function(Blueprint $table) {
            $table->foreign('user_id', 'subscriptions_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_categories', function (Blueprint $table) {
            $table->dropColumn('is_subs');
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign('subscriptions_1');
        });
        Schema::dropIfExists('subscriptions');
    }
}