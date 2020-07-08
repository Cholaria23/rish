<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsNoimage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('units_params', function(Blueprint $table) {
            $table->string('big_width_noimage_units', 255)->default(2000);
            $table->string('small_width_noimage_units', 255)->default(500);
            $table->string('thumb_width_noimage_units', 255)->default(200);
            $table->string('mini_width_noimage_units', 255)->default(100);
            $table->string('big_width_noimage_cats', 255)->default(2000);
            $table->string('small_width_noimage_cats', 255)->default(500);
            $table->string('thumb_width_noimage_cats', 255)->default(200);
            $table->string('mini_width_noimage_cats', 255)->default(100);

            \Storage::disk('public')->makeDirectory('noimage/units');
            \Storage::disk('public')->makeDirectory('noimage/units/units');
            \Storage::disk('public')->makeDirectory('noimage/units/units/big');
            \Storage::disk('public')->makeDirectory('noimage/units/units/small');
            \Storage::disk('public')->makeDirectory('noimage/units/units/thumb');
            \Storage::disk('public')->makeDirectory('noimage/units/units/mini');
            \Storage::disk('public')->makeDirectory('noimage/units/cats');
            \Storage::disk('public')->makeDirectory('noimage/units/cats/big');
            \Storage::disk('public')->makeDirectory('noimage/units/cats/small');
            \Storage::disk('public')->makeDirectory('noimage/units/cats/thumb');
            \Storage::disk('public')->makeDirectory('noimage/units/cats/mini');

            $noimage_units = \DB::table('units_params')->first()->noimage_units;
            $noimage_cats = \DB::table('units_params')->first()->noimage_cats;

            if ($noimage_units != '') {
                $noimage_units = str_replace('noimage/', '', $noimage_units);
                \DB::table('units_params')->update(['noimage_units' => $noimage_units]);
                if (is_file('storage/app/public/noimage/'.$noimage_units)){
                    $file = 'storage/app/public/noimage/'.$noimage_units;
                    copy($file, 'storage/app/public/noimage/units/units/big/'.$noimage_units);
                    copy($file, 'storage/app/public/noimage/units/units/small/'.$noimage_units);
                    copy($file, 'storage/app/public/noimage/units/units/thumb/'.$noimage_units);
                    copy($file, 'storage/app/public/noimage/units/units/mini/'.$noimage_units);
                    unlink('storage/app/public/noimage/'.$noimage_units);
                }
            }

            if ($noimage_cats != '') {
                $noimage_cats = str_replace('noimage/', '', $noimage_cats);
                \DB::table('units_params')->update(['noimage_cats' => $noimage_cats]);
                if (is_file('storage/app/public/noimage/'.$noimage_cats)){
                    $file = 'storage/app/public/noimage/'.$noimage_cats;
                    copy($file, 'storage/app/public/noimage/units/cats/big/'.$noimage_cats);
                    copy($file, 'storage/app/public/noimage/units/cats/small/'.$noimage_cats);
                    copy($file, 'storage/app/public/noimage/units/cats/thumb/'.$noimage_cats);
                    copy($file, 'storage/app/public/noimage/units/cats/mini/'.$noimage_cats);
                    unlink('storage/app/public/noimage/'.$noimage_cats);
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
        Schema::table('units_params', function (Blueprint $table) {
            $table->dropColumn('big_width_noimage_units');
            $table->dropColumn('small_width_noimage_units');
            $table->dropColumn('thumb_width_noimage_units');
            $table->dropColumn('mini_width_noimage_units');
            $table->dropColumn('big_width_noimage_cats');
            $table->dropColumn('small_width_noimage_cats');
            $table->dropColumn('thumb_width_noimage_cats');
            $table->dropColumn('mini_width_noimage_cats');
        });
    }
}