<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InterUnits extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
 

        Schema::create('interactive_images_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inter_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('interactive_images_units', function (Blueprint $table) {
            $table->foreign('unit_id', 'interactive_images_units_unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('inter_id', 'interactive_images_units_image_id')->references('id')->on('interactive_images')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        $exist_relations = \DB::table('interactive_images')->whereNotNull('unit_id')->where('unit_id', '!=', '')->get();
        $order = 0;
        foreach ($exist_relations as $exist_relation) {
            \DB::table('interactive_images_units')->insert([
                'inter_id' => $exist_relation->id,
                'unit_id' => $exist_relation->unit_id,
            ]);
            $order ++;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('interactive_images_units', function (Blueprint $table) {
            $table->dropForeign('interactive_images_units_unit_id');
            $table->dropForeign('interactive_images_units_image_id');
        });
        Schema::dropIfExists('interactive_images_units');
    }
}
