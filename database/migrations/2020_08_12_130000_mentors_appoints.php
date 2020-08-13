<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MentorsAppoints extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        $parent_id = DB::table('sections')->where('alias', 'specialists')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'specialists_appoints',
                'lang_name' => 'AdminPanel::main.sections.specialists_appoints',
                'route' => 'admin.specialists.appoints',
                'parent_id' => $parent_id,
            ],
        ]);

        Schema::table('specialists_appoints', function (Blueprint $table) {
            $table->boolean('is_review_sent')->default(0);
            $table->boolean('is_cancel_sent')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_appoints', function (Blueprint $table) {
            $table->dropColumn('is_review_sent');
            $table->dropColumn('is_cancel_sent');
        });
        DB::table('sections')->whereIn('alias', ['specialists_appoints'])->delete();
    }
}
