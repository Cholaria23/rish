<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketLeadsRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leads_market_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_id');
            $table->unsignedInteger('cat_id');
            $table->integer('sort_order')->default(0);
        });
        Schema::create('leads_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_id');
            $table->unsignedInteger('good_id');
            $table->integer('sort_order')->default(0);
        });

        Schema::table('leads_market_cats', function (Blueprint $table) {
            $table->foreign('lead_id', 'leads_market_cats_lead_id_ibfk')->references('id')->on('leads')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'leads_market_cats_cat_id_ibfk')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('leads_goods', function (Blueprint $table) {
            $table->foreign('lead_id', 'leads_goods_lead_id_ibfk')->references('id')->on('leads')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('good_id', 'leads_goods_good_id_ibfk')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        $leads = DB::table('leads')->select(['id', 'good_id', 'market_cat_id'])->where(function($query) {
            $query->whereNotNull('good_id');
            $query->orWhereNotNull('market_cat_id');
        })->get();

        $insert_cats = [];
        $insert_goods = [];

        foreach($leads as $lead){
            if($lead->good_id){
                $insert_goods[] = [
                    'lead_id' => $lead->id,
                    'good_id' => $lead->good_id,
                ];
            }

            if($lead->market_cat_id) {
                $insert_cats[] = [
                    'lead_id' => $lead->id,
                    'cat_id' => $lead->market_cat_id,
                ];
            }
        }

        DB::table('leads_market_cats')->insert($insert_cats);
        DB::table('leads_goods')->insert($insert_goods);

        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign('leads_6');
            $table->dropForeign('leads_7');
        });

        Schema::table('leads', function(Blueprint $table) {
            $table->dropColumn('good_id');
            $table->dropColumn('market_cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('leads', function(Blueprint $table) {
            $table->integer('good_id')->unsigned()->index()->nullable();
            $table->integer('market_cat_id')->unsigned()->index()->nullable();
            $table->foreign('good_id', 'leads_6')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('market_cat_id', 'leads_7')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('leads_market_cats', function (Blueprint $table) {
            $table->dropForeign( 'leads_market_cats_lead_id_ibfk');
            $table->dropForeign( 'leads_market_cats_cat_id_ibfk');
        });

        Schema::table('leads_goods', function (Blueprint $table) {
            $table->dropForeign( 'leads_goods_lead_id_ibfk');
            $table->dropForeign( 'leads_goods_good_id_ibfk');
        });

        Schema::dropIfExists('leads_market_cats');
        Schema::dropIfExists('leads_goods');
    }
}
