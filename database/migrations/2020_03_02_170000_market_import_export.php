<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketImportExport extends Migration
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
                'alias' => 'market_import_xml',
                'lang_name' => 'Market::main.sections.import_xml',
                'route' => 'admin.market.importXml',
                'parent_id' => $parent_id
            ],
        ]);


        $parent_id = DB::table('sections')->where('alias', 'market')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'market_export_xml',
                'lang_name' => 'Market::main.sections.export_xml',
                'route' => 'admin.market.exportXml',
                'parent_id' => $parent_id
            ],
        ]);

        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->text('export_template')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->dropColumn('export_template');
        });  
        DB::table('sections')->where('alias', 'market_import_xml')->delete();  
        DB::table('sections')->where('alias', 'market_export_xml')->delete();  
    }
}
