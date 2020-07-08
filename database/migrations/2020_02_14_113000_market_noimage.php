<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketNoimage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('market_params', function(Blueprint $table) {
            $table->string('big_width_noimage_goods', 255)->default(2000);
            $table->string('small_width_noimage_goods', 255)->default(500);
            $table->string('thumb_width_noimage_goods', 255)->default(200);
            $table->string('mini_width_noimage_goods', 255)->default(100);
            $table->string('big_width_noimage_cats', 255)->default(2000);
            $table->string('small_width_noimage_cats', 255)->default(500);
            $table->string('thumb_width_noimage_cats', 255)->default(200);
            $table->string('mini_width_noimage_cats', 255)->default(100);

            \Storage::disk('public')->makeDirectory('noimage/market');
            \Storage::disk('public')->makeDirectory('noimage/market/goods');
            \Storage::disk('public')->makeDirectory('noimage/market/goods/big');
            \Storage::disk('public')->makeDirectory('noimage/market/goods/small');
            \Storage::disk('public')->makeDirectory('noimage/market/goods/thumb');
            \Storage::disk('public')->makeDirectory('noimage/market/goods/mini');
            \Storage::disk('public')->makeDirectory('noimage/market/cats');
            \Storage::disk('public')->makeDirectory('noimage/market/cats/big');
            \Storage::disk('public')->makeDirectory('noimage/market/cats/small');
            \Storage::disk('public')->makeDirectory('noimage/market/cats/thumb');
            \Storage::disk('public')->makeDirectory('noimage/market/cats/mini');

            $noimage_market_goods = \DB::table('market_params')->first()->noimage_market_goods;
            $noimage_market_cats = \DB::table('market_params')->first()->noimage_market_cats;

            if ($noimage_market_goods != '') {
                $noimage_market_goods = str_replace('noimage/', '', $noimage_market_goods);
                \DB::table('market_params')->update(['noimage_market_goods' => $noimage_market_goods]);
                if (is_file('storage/app/public/noimage/'.$noimage_market_goods)){
                    $file = 'storage/app/public/noimage/'.$noimage_market_goods;
                    copy($file, 'storage/app/public/noimage/market/goods/big/'.$noimage_market_goods);
                    copy($file, 'storage/app/public/noimage/market/goods/small/'.$noimage_market_goods);
                    copy($file, 'storage/app/public/noimage/market/goods/thumb/'.$noimage_market_goods);
                    copy($file, 'storage/app/public/noimage/market/goods/mini/'.$noimage_market_goods);
                    unlink('storage/app/public/noimage/'.$noimage_market_goods);
                }
            }

            if ($noimage_market_cats != '') {
                $noimage_market_cats = str_replace('noimage/', '', $noimage_market_cats);
                \DB::table('market_params')->update(['noimage_market_cats' => $noimage_market_cats]);
                if (is_file('storage/app/public/noimage/'.$noimage_market_cats)){
                    $file = 'storage/app/public/noimage/'.$noimage_market_cats;
                    copy($file, 'storage/app/public/noimage/market/cats/big/'.$noimage_market_cats);
                    copy($file, 'storage/app/public/noimage/market/cats/small/'.$noimage_market_cats);
                    copy($file, 'storage/app/public/noimage/market/cats/thumb/'.$noimage_market_cats);
                    copy($file, 'storage/app/public/noimage/market/cats/mini/'.$noimage_market_cats);
                    unlink('storage/app/public/noimage/'.$noimage_market_cats);
                }
            }
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {


        Schema::table('market_params', function (Blueprint $table) {
            $table->dropColumn('big_width_noimage_goods');
            $table->dropColumn('small_width_noimage_goods');
            $table->dropColumn('thumb_width_noimage_goods');
            $table->dropColumn('mini_width_noimage_goods');
            $table->dropColumn('big_width_noimage_cats');
            $table->dropColumn('small_width_noimage_cats');
            $table->dropColumn('thumb_width_noimage_cats');
            $table->dropColumn('mini_width_noimage_cats');
        });
    }
}