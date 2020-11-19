<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InterSeo extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('interactive_images', function (Blueprint $table) {
            $table->string('alias', 255)->nullable();
            $table->boolean('is_noindex')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('interactive_images_lang', function (Blueprint $table) {
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_key', 255)->nullable();
            $table->string('h1', 255)->nullable();
            $table->string('canonical', 255)->nullable();
            $table->text('tags')->nullable();
            $table->text('meta_desc')->nullable();
        });

        $images = DB::table('interactive_images')->get();
        foreach ($images as $image) {
            $id = $image->id;
            DB::table('interactive_images')->where('id', $id)->update(['alias' => $id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('interactive_images_lang', function (Blueprint $table) {
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_key');
            $table->dropColumn('h1');
            $table->dropColumn('canonical');
            $table->dropColumn('tags');
            $table->dropColumn('meta_desc');
        });

        Schema::table('interactive_images', function (Blueprint $table) {
            $table->dropColumn('alias');
            $table->dropColumn('is_noindex');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('deleted_at');
        });
    }
}
