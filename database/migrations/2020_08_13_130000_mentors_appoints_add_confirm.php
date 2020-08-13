<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MentorsAppointsAddConfirm extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('specialists_appoints', function (Blueprint $table) {
            $table->boolean('is_add_confirm_sent')->default(0);
            $table->string('hash', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_appoints', function (Blueprint $table) {
            $table->dropColumn('is_add_confirm_sent');
            $table->dropColumn('hash');
        });
    }
}
