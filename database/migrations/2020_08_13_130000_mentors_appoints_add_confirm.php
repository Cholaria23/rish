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
            $table->string('hash', 255)->nullable();
            $table->date('add_confirm_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_appoints', function (Blueprint $table) {
            $table->dropColumn('hash');
            $table->dropColumn('add_confirm_date');
        });
    }
}
