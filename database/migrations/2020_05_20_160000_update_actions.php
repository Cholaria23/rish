<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateActions extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units', function(Blueprint $table) {
            $table->dateTime('action_date_start')->nullable();
            $table->dateTime('action_date_end')->nullable();
        });

        $goods_actions = DB::table('market_goods_actions')->get();
        foreach ($goods_actions as $goods_action) {
            if ($goods_action->start != '') {
                DB::table('units')->where('id', $goods_action->unit_id)->update(['action_date_start' => $goods_action->start]);
            }
            if ($goods_action->end != '') {
                DB::table('units')->where('id', $goods_action->unit_id)->update(['action_date_end' => $goods_action->end]);
            }
        }

        $cats_actions = DB::table('market_cats_actions')->get();
        foreach ($cats_actions as $cats_action) {
            if ($cats_action->start != '') {
                DB::table('units')->where('id', $cats_action->unit_id)->update(['action_date_start' => $cats_action->start]);
            }
            if ($cats_action->end != '') {
                DB::table('units')->where('id', $cats_action->unit_id)->update(['action_date_end' => $cats_action->end]);
            }
        }

        Schema::table('market_goods_actions', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
        });

        Schema::table('market_cats_actions', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('market_goods_actions', function(Blueprint $table) {
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
        });

        Schema::table('market_cats_actions', function(Blueprint $table) {
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
        });

        $goods_actions = DB::table('market_goods_actions')->get();
        foreach ($goods_actions as $goods_action) {
            $unit = DB::table('units')->where('id', $goods_action->unit_id)->first();
            DB::table('market_goods_actions')->where('unit_id', $goods_action->unit_id)->where('good_id', $goods_action->good_id)->update(['start' => $unit->action_date_start, 'end' => $unit->action_date_end]);
        }

        $cats_actions = DB::table('market_cats_actions')->get();
        foreach ($cats_actions as $cats_action) {
            $cat = DB::table('units')->where('id', $cats_action->unit_id)->first();
            DB::table('market_cats_actions')->where('unit_id', $cats_action->unit_id)->where('cat_id', $cats_action->cat_id)->update(['start' => $cat->action_date_start, 'end' => $cat->action_date_end]);
        } 
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('action_date_start');
            $table->dropColumn('action_date_end');
        });
    }
}