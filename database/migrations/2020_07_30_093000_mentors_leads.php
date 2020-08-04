<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MentorsLeads extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('specialists_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_id');
            $table->unsignedInteger('specialist_id');
            $table->integer('sort_order')->default(0);
        });

        Schema::table('specialists_leads', function (Blueprint $table) {
            $table->foreign('lead_id', 'specialists_leads_1')->references('id')->on('leads')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('specialist_id', 'specialists_leads_2')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_leads', function (Blueprint $table) {
            $table->dropForeign('specialists_leads_1');
            $table->dropForeign('specialists_leads_2');
        });
        Schema::dropIfExists('specialists_leads');
    }
}
