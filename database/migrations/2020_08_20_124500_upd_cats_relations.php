<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdCatsRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_rel_types', function(Blueprint $table) {
            $table->boolean('is_cats_relation')->default(0);
        });
        Schema::table('units_cats_relations', function(Blueprint $table) {
            $table->integer('rel_type_id')->nullable()->index()->unsigned();
            $table->foreign('rel_type_id', 'units_cats_relations_3')->references('id')->on('units_rel_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('units_rel_types')->insert([
            'is_undeletable' => 1,
            'name' => '{"ru":"\u0421\u0432\u044f\u0437\u0430\u043d\u043d\u0430\u044f \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u044f","uk":"\u041f\u043e\u0432\'\u044f\u0437\u0430\u043d\u0430 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0456\u044f"}',
            'is_cats_relation' => 1,
        ]);

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('units_rel_types')->where('is_cats_relation', 1)->delete();
        Schema::table('units_cats_relations', function (Blueprint $table) {
            $table->dropForeign('units_cats_relations_3');
            $table->dropColumn('rel_type_id');
        });   
        Schema::table('units_rel_types', function(Blueprint $table) {
            $table->dropColumn('is_cats_relation');
        });
    }
}