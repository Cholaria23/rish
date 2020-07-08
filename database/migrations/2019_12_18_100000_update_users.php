<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_banned')->default(0);
        });
        Schema::table('leads', function(Blueprint $table) {
            $table->integer('user_id')->nullable()->index()->unsigned();
            $table->foreign('user_id', 'leads_8')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_banned');
        });
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign('leads_8');
            $table->dropColumn('user_id');
        });
    }
}
