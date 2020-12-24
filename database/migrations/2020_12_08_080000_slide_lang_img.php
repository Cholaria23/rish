<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SlideLangImg extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('slider', function (Blueprint $table) {
            $table->string('img_uhd', 255)->nullable();
        });

        Schema::table('slides_lang', function (Blueprint $table) {
            $table->string('img_uhd', 255)->nullable();
            $table->string('img_desktop', 255)->nullable();
            $table->string('img_mobile', 255)->nullable();
        });

        $slides = \DB::table('slides')->get();
        if ($slides->count()) {
            $def_lang = \DB::table('languages')->where('default', 1)->first()->code;
            foreach ($slides as $slide) {
                $ext = pathinfo('storage/slider/img_desktop/'.$slide->img_desktop, PATHINFO_EXTENSION);
                $img_desktop = str_replace(".".$ext, "-".$def_lang.".".$ext, $slide->img_desktop);
                $ext = pathinfo('storage/slider/img_mobile/'.$slide->img_mobile, PATHINFO_EXTENSION);
                $img_mobile = str_replace(".".$ext, "-".$def_lang.".".$ext, $slide->img_mobile);
                \DB::table('slides_lang')->where('slide_id', $slide->id)->where('lang', $def_lang)->update([
                    'img_desktop' => $img_desktop,
                    'img_mobile' => $img_mobile,
                ]);

                if (is_file('storage/app/public/slider/img_desktop/'.$slide->img_desktop)) {
                    rename('storage/app/public/slider/img_desktop/'.$slide->img_desktop, 'storage/app/public/slider/img_desktop/'.$img_desktop);
                }

                if (is_file('storage/app/public/slider/img_mobile/'.$slide->img_mobile)) {
                    rename('storage/app/public/slider/img_mobile/'.$slide->img_mobile, 'storage/app/public/slider/img_mobile/'.$img_mobile);
                }
            }
        }

        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('img_desktop');
            $table->dropColumn('img_mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('slider', function (Blueprint $table) {
            $table->string('img_uhd', 255)->nullable();
        });

        Schema::table('slides', function (Blueprint $table) {
            $table->string('img_desktop', 255)->nullable();
            $table->string('img_mobile', 255)->nullable();
        });

        $def_lang = \DB::table('languages')->where('default', 1)->first()->code;
        $slides = \DB::table('slides_lang')->where('lang', $def_lang)->get();

        foreach ($slides as $slide) {
            $ext = pathinfo('storage/slider/img_desktop/'.$slide->img_desktop, PATHINFO_EXTENSION);
            $img_desktop = str_replace("-".$def_lang.".".$ext, ".".$ext, $slide->img_desktop);
            $ext = pathinfo('storage/slider/img_mobile/'.$slide->img_mobile, PATHINFO_EXTENSION);
            $img_mobile = str_replace("-".$def_lang.".".$ext, ".".$ext, $slide->img_mobile);
            \DB::table('slides')->where('id', $slide->slide_id)->update([
                'img_desktop' => $img_desktop,
                'img_mobile' => $img_mobile,
            ]);

            if (is_file('storage/app/public/slider/img_desktop/'.$slide->img_desktop)) {
                rename('storage/app/public/slider/img_desktop/'.$slide->img_desktop, 'storage/app/public/slider/img_desktop/'.$img_desktop);
            }

            if (is_file('storage/app/public/slider/img_mobile/'.$slide->img_mobile)) {
                rename('storage/app/public/slider/img_mobile/'.$slide->img_mobile, 'storage/app/public/slider/img_mobile/'.$img_mobile);
            }
        }



        Schema::table('slides_lang', function (Blueprint $table) {
            $table->dropColumn('img_uhd');
            $table->dropColumn('img_desktop');
            $table->dropColumn('img_mobile');
        });

    }
}
