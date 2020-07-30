<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MentorsTimetableFix extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('specialists_params', function(Blueprint $table){
            $table->dropColumn('appoint_interval');
            $table->dropColumn('appoint_start');
            $table->dropColumn('appoint_end');
            $table->dropColumn('work_days');
        });
        Schema::table('specialists', function(Blueprint $table){
            $table->integer('appoint_interval')->default(15);
            $table->string('work_days')->default("1,2,3,4,5,6,7");
            $table->string('work_day_1_start')->default("10:00");
            $table->string('work_day_1_end')->default("20:00");
            $table->string('work_day_2_start')->default("10:00");
            $table->string('work_day_2_end')->default("20:00");
            $table->string('work_day_3_start')->default("10:00");
            $table->string('work_day_3_end')->default("20:00");
            $table->string('work_day_4_start')->default("10:00");
            $table->string('work_day_4_end')->default("20:00");
            $table->string('work_day_5_start')->default("10:00");
            $table->string('work_day_5_end')->default("20:00");
            $table->string('work_day_6_start')->default("10:00");
            $table->string('work_day_6_end')->default("20:00");
            $table->string('work_day_7_start')->default("10:00");
            $table->string('work_day_7_end')->default("20:00");
        });

        Schema::table('specialists_appoints', function (Blueprint $table) {
            $table->text('company_name')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('link')->nullable();
            $table->text('business_age')->nullable();
            $table->text('question')->nullable();
            $table->text('measures')->nullable();
            $table->text('helpers')->nullable();
            $table->boolean('is_email_sent')->default(0);
            $table->integer('cat_id')->nullable()->index()->unsigned();
        });
        Schema::table('specialists_appoints', function(Blueprint $table) {
            $table->foreign('cat_id', 'specialists_appoints_3')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_params', function(Blueprint $table){
            $table->integer('appoint_interval')->default(15);
            $table->string('appoint_start')->default("10:00");
            $table->string('appoint_end')->default("20:00");
            $table->string('work_days')->default("1,2,3,4,5,6,7");
        });

        Schema::table('specialists', function(Blueprint $table){
            $table->dropColumn('appoint_interval');
            $table->dropColumn('work_days');
            $table->dropColumn('work_day_1_start');
            $table->dropColumn('work_day_1_end');
            $table->dropColumn('work_day_2_start');
            $table->dropColumn('work_day_2_end');
            $table->dropColumn('work_day_3_start');
            $table->dropColumn('work_day_3_end');
            $table->dropColumn('work_day_4_start');
            $table->dropColumn('work_day_4_end');
            $table->dropColumn('work_day_5_start');
            $table->dropColumn('work_day_5_end');
            $table->dropColumn('work_day_6_start');
            $table->dropColumn('work_day_6_end');
            $table->dropColumn('work_day_7_start');
            $table->dropColumn('work_day_7_end');
        });

        Schema::table('specialists_appoints', function (Blueprint $table) {
            $table->dropForeign('specialists_appoints_3');
        });

        Schema::table('specialists_appoints', function(Blueprint $table){
            $table->dropColumn('company_name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('link');
            $table->dropColumn('business_age');
            $table->dropColumn('question');
            $table->dropColumn('measures');
            $table->dropColumn('helpers');
            $table->dropColumn('is_email_sent');
            $table->dropColumn('cat_id');
        });
    }
}
