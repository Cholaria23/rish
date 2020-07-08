<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeadsRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leads_units_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_id');
            $table->unsignedInteger('cat_id');
            $table->integer('sort_order')->default(0);
        });
        Schema::create('leads_units', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_id');
            $table->unsignedInteger('unit_id');
            $table->integer('sort_order')->default(0);
        });

        Schema::table('leads_units_cats', function (Blueprint $table) {
            $table->foreign('lead_id', 'leads_units_cats_lead_id_ibfk')->references('id')->on('leads')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'leads_units_cats_cat_id_ibfk')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('leads_units', function (Blueprint $table) {
            $table->foreign('lead_id', 'leads_units_lead_id_ibfk')->references('id')->on('leads')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('unit_id', 'leads_units_unit_id_ibfk')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        $leads = DB::table('leads')->select(['id', 'unit_id', 'cat_id'])->where(function($query) {
            $query->whereNotNull('unit_id');
            $query->orWhereNotNull('cat_id');
        })->get();

        $insert_cats = [];
        $insert_units = [];

        foreach($leads as $lead){
            if($lead->unit_id){
                $insert_units[] = [
                    'lead_id' => $lead->id,
                    'unit_id' => $lead->unit_id,
                ];
            }

            if($lead->cat_id) {
                $insert_cats[] = [
                    'lead_id' => $lead->id,
                    'cat_id' => $lead->cat_id,
                ];
            }
        }

        DB::table('leads_units_cats')->insert($insert_cats);
        DB::table('leads_units')->insert($insert_units);

        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign('leads_3');
            $table->dropForeign('leads_4');
        });

        Schema::table('leads', function(Blueprint $table) {
            $table->dropColumn('unit_id');
            $table->dropColumn('cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('leads', function(Blueprint $table) {
            $table->integer('unit_id')->unsigned()->index()->nullable();
            $table->integer('cat_id')->unsigned()->index()->nullable();
            $table->foreign('unit_id', 'leads_3')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'leads_4')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('leads_units_cats', function (Blueprint $table) {
            $table->dropForeign( 'leads_units_cats_lead_id_ibfk');
            $table->dropForeign( 'leads_units_cats_cat_id_ibfk');
        });

        Schema::table('leads_units', function (Blueprint $table) {
            $table->dropForeign( 'leads_units_lead_id_ibfk');
            $table->dropForeign( 'leads_units_unit_id_ibfk');
        });

        Schema::dropIfExists('leads_units_cats');
        Schema::dropIfExists('leads_units');
    }
}
