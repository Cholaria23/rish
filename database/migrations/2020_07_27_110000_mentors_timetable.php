<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MentorsTimetable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('specialists_params', function(Blueprint $table){
            $table->integer('appoint_interval')->default(15);
            $table->string('appoint_start')->default("10:00");
            $table->string('appoint_end')->default("20:00");
            $table->string('work_days')->default("1,2,3,4,5,6,7");
        });

        Schema::create('specialists_appoints', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('specialist_id')->nullable()->index()->unsigned();
            $table->integer('unit_id')->nullable()->index()->unsigned();
            $table->date('date')->nullable();
            $table->string('status', 255)->default('new');
            $table->string('time', 255)->nullable();
            $table->text('client')->nullable();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('specialists_appoints', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_appoints_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('unit_id', 'specialists_appoints_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_params', function(Blueprint $table){
            $table->dropColumn('appoint_interval');
            $table->dropColumn('appoint_start');
            $table->dropColumn('appoint_end');
            $table->dropColumn('work_days');
        });

        Schema::table('specialists_appoints', function (Blueprint $table) {
            $table->dropForeign('specialists_appoints_1');
            $table->dropForeign('specialists_appoints_2');
        });

        Schema::dropIfExists('specialists_appoints');
    }
}
