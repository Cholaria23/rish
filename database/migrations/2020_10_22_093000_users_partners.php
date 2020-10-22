<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('partner_visits_count')->default(0);
            $table->string('partner_hash', 255)->nullable();
            $table->string('referer_hash', 255)->nullable();
            $table->boolean('is_partner_active')->default(0);
        });

        $users = DB::table('users')->get();
        foreach ($users as $user) {
            DB::table('users')->where('id', $user->id)->update(['partner_hash' => uniqid()]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('partner_visits_count');
            $table->dropColumn('partner_hash');
            $table->dropColumn('referer_hash');
            $table->dropColumn('is_partner_active');
        });
    }
}
