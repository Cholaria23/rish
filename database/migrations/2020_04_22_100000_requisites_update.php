<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequisitesUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisites', function (Blueprint $table) {
            $table->boolean('is_used')->default(1);
            $table->boolean('is_default')->default(0);
            $table->string('site', 255)->nullable();
            $table->string('signer_1_post', 255)->nullable();
            $table->string('signer_1_name', 255)->nullable();
            $table->string('signer_2_post', 255)->nullable();
            $table->string('signer_2_name', 255)->nullable();
            $table->string('signer_3_post', 255)->nullable();
            $table->string('signer_3_name', 255)->nullable();
            $table->text('invoice_info')->nullable();
            $table->text('sales_receipt_info')->nullable();
            $table->text('warranty_info')->nullable();
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('requisites', function (Blueprint $table) {
            $table->dropColumn('is_used');
            $table->dropColumn('is_default');
            $table->dropColumn('site');
            $table->dropColumn('signer_1_post');
            $table->dropColumn('signer_1_name');
            $table->dropColumn('signer_2_post');
            $table->dropColumn('signer_2_name');
            $table->dropColumn('signer_3_post');
            $table->dropColumn('signer_3_name');
            $table->dropColumn('invoice_info');
            $table->dropColumn('sales_receipt_info');
            $table->dropColumn('warranty_info');
        });
    }
}