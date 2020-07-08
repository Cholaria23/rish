<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent_id = DB::table('sections')->where('alias', 'cms_params')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'about_cms',
                'lang_name' => 'AdminPanel::main.sections.about_cms',
                'route' => 'admin.aboutCms',
                'parent_id' => $parent_id,
            ],
        ]);

        Schema::create('update_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package', 255)->nullable();
            $table->string('version', 255)->nullable();
            $table->dateTime('date');
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'about_cms')->delete();
        Schema::dropIfExists('update_logs');
    }
}
