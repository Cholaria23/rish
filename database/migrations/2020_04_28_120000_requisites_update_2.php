<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequisitesUpdate2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisites', function (Blueprint $table) {
            $table->string('recipient', 255)->nullable();
            $table->string('recipient_bank', 255)->nullable();
            $table->string('mfo', 255)->nullable();
            $table->string('r_s', 255)->nullable();
            $table->string('iban', 255)->nullable();
            $table->string('edrpou', 255)->nullable();
            $table->string('ipn', 255)->nullable();
            $table->string('pay_form', 255)->nullable();
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('requisites', function (Blueprint $table) {
            $table->dropColumn('recipient');
            $table->dropColumn('recipient_bank');
            $table->dropColumn('mfo');
            $table->dropColumn('r_s');
            $table->dropColumn('iban');
            $table->dropColumn('edrpou');
            $table->dropColumn('ipn');
            $table->dropColumn('pay_form');
        });
    }
}