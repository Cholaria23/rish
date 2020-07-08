<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTimetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timetables_params', function (Blueprint $table) {
            $table->integer('start')->default(6)->nullable();
            $table->integer('end')->default(22)->nullable();
        });

        Schema::table('timetables_events', function(Blueprint $table) {
            $table->foreign('timetable_id', 'timetables_events_1')->references('id')->on('timetables')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('timetables_events', function (Blueprint $table) {
            $table->dropForeign('timetables_events_1');
        });
        Schema::table('timetables_params', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}
