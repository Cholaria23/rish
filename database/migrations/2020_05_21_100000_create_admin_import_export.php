<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminImportExport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $parent_id = DB::table('sections')->where('alias', 'units')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'units_import_xls',
                'lang_name' => 'AdminPanel::main.sections.import_xls',
                'route' => 'admin.units.importXls',
                'parent_id' => $parent_id
            ],
        ]);
        DB::table('sections')->insert([
            [
                'alias' => 'units_export_xls',
                'lang_name' => 'AdminPanel::main.sections.export_xls',
                'route' => 'admin.units.exportXls',
                'parent_id' => $parent_id
            ],
        ]);

        Schema::create('units_users_params', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index()->nullable();
            $table->text('export_template')->nullable();
            $table->text('import_template')->nullable();
        });


        Schema::table('units_users_params', function(Blueprint $table) {
            $table->foreign('account_id', 'units_users_params_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_users_params', function (Blueprint $table) {
            $table->dropForeign('units_users_params_1');
        });
        Schema::dropIfExists('units_users_params');

        DB::table('sections')->where('alias', 'units_import_xls')->delete();
        DB::table('sections')->where('alias', 'units_export_xls')->delete();
    }
}
