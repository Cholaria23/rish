<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketRenameImportExport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('sections')->where('alias', 'market_import_xml')->delete();  
        DB::table('sections')->where('alias', 'market_export_xml')->delete(); 

        $parent_id = DB::table('sections')->where('alias', 'market')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'market_import_xls',
                'lang_name' => 'Market::main.sections.import_xls',
                'route' => 'admin.market.importXls',
                'parent_id' => $parent_id
            ],
        ]);
        DB::table('sections')->insert([
            [
                'alias' => 'market_export_xls',
                'lang_name' => 'Market::main.sections.export_xls',
                'route' => 'admin.market.exportXls',
                'parent_id' => $parent_id
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() { 
        DB::table('sections')->where('alias', 'market_import_xls')->delete();  
        DB::table('sections')->where('alias', 'market_export_xls')->delete();  

        $parent_id = DB::table('sections')->where('alias', 'market')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'market_import_xml',
                'lang_name' => 'Market::main.sections.import_xml',
                'route' => 'admin.market.importXml',
                'parent_id' => $parent_id
            ],
        ]);
        DB::table('sections')->insert([
            [
                'alias' => 'market_export_xml',
                'lang_name' => 'Market::main.sections.export_xml',
                'route' => 'admin.market.exportXml',
                'parent_id' => $parent_id
            ],
        ]);
    }
}
