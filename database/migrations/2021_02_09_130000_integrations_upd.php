<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntegrationsUpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $parent_id = DB::table('sections')->where('alias', 'integrations')->first()->id;

        DB::table('sections')->insert([
            [
                'alias'      => 'privatbank',
                'lang_name'  => 'AdminPanel::main.sections.privatbank',
                'route'      => 'admin.privatbank',
                'parent_id'  => $parent_id,
                'is_in_menu' => 0,
            ],
            [
                'alias'      => 'monobank',
                'lang_name'  => 'AdminPanel::main.sections.monobank',
                'route'      => 'admin.monobank',
                'parent_id'  => $parent_id,
                'is_in_menu' => 0,
            ],
        ]);

        DB::table('integrations')->insert([
            [
                'alias' => 'privatbank',
            ],
            [
                'alias' => 'monobank',
            ],
        ]);


       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('integrations')->whereIn('alias', ['privatbank', 'monobank'])->delete();

        DB::table('sections')->whereIn('alias', ['privatbank', 'monobank'])->delete();

    }
}