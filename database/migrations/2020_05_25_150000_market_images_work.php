<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketImagesWork extends Migration
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
                'alias' => 'images_work',
                'lang_name' => 'Market::main.sections.images_work',
                'route' => 'admin.market.imagesWork',
                'parent_id' => $parent_id,
            ],
        ]);    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'images_work')->delete();
    }
}