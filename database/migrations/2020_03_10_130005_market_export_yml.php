<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketExportYml extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $parent_id = DB::table('sections')->where('alias', 'market')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'market_export_yml',
                'lang_name' => 'Market::main.sections.export_yml',
                'route' => 'admin.market.exportYml',
                'parent_id' => $parent_id,
                'is_in_menu' => 0
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'market_export_yml')->delete();  
    }
}
