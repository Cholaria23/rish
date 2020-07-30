<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentors extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        DB::table('sections')->insert([
            [
                'alias' => 'specialists',
                'lang_name' => 'AdminPanel::main.sections.specialists',
                'route' => 'admin.specialists.index',
            ]
        ]);

        $parent_id = DB::table('sections')->where('alias', 'specialists')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'specialists_list',
                'lang_name' => 'AdminPanel::main.sections.specialists_list',
                'route' => 'admin.specialists.list',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'specialists_params',
                'lang_name' => 'AdminPanel::main.sections.specialists_params',
                'route' => 'admin.specialists.params',
                'parent_id' => $parent_id,
            ],
        ]);

        Schema::create('specialists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->string('alias', 255)->nullable();
            $table->string('nickname', 255)->nullable();
            $table->datetime('birthdate')->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('img_1', 255)->nullable();
            $table->string('img_2', 255)->nullable();
            $table->string('post_code', 255)->nullable();
            $table->string('phone_1', 255)->nullable();
            $table->string('phone_2', 255)->nullable();
            $table->string('phone_3', 255)->nullable();
            $table->string('email_1', 255)->nullable();
            $table->string('email_2', 255)->nullable();
            $table->string('viber', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();
            $table->string('skype', 255)->nullable();
            $table->string('facebook_messenger', 255)->nullable();
            $table->string('telegram', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('vk', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->boolean('is_block')->default(1);
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_top')->default(0);
            $table->boolean('is_noindex')->default(1);
            $table->boolean('is_confirmed')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('specialists_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specialist_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('father_name', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('district', 255)->nullable();
            $table->string('education', 255)->nullable();
            $table->text('short_desc_1')->nullable();
            $table->text('short_desc_2')->nullable();
            $table->text('long_desc_1')->nullable();
            $table->text('long_desc_2')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_key', 255)->nullable();
            $table->string('h1', 255)->nullable();
            $table->string('canonical', 255)->nullable();
            $table->text('tags')->nullable();
            $table->text('meta_desc')->nullable();
        });

        Schema::table('specialists_lang', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_lang_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_xp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->integer('specialist_id')->unsigned()->index();
            $table->string('start', 255)->nullable();
            $table->string('end', 255)->nullable();
        });

        Schema::table('specialists_xp', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_xp_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_xp_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specialist_xp_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('post', 255)->nullable();
            $table->string('work_place', 255)->nullable();
        });

        Schema::table('specialists_xp_lang', function(Blueprint $table) {
            $table->foreign('specialist_xp_id', 'specialists_xp_lang_1')->references('id')->on('specialists_xp')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_files', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('specialist_id')->unsigned()->index();
            $table->integer('file_id')->nullable()->index()->unsigned();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('specialists_files', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_files_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('file_id', 'specialists_files_2')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specialist_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->string('poster_src', 255)->nullable();
            $table->string('video_src', 255)->nullable();
            $table->string('video_id', 255)->nullable();
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_autoplay')->default(1);
            $table->boolean('is_controls')->default(1);
            $table->boolean('is_loop')->default(1);
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('specialists_videos', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_videos_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('specialists_videos_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description_1', 255)->nullable();
            $table->string('description_2', 255)->nullable();
        });

        Schema::table('specialists_videos_lang', function(Blueprint $table) {
            $table->foreign('video_id', 'specialists_videos_lang_1')->references('id')->on('specialists_videos')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('specialists_images', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('specialist_id')->nullable()->unsigned()->index();
            $table->string('src', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->integer('group')->default(1);
            $table->boolean('is_hidden')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('specialists_images', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_images_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_images_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
        });

        Schema::table('specialists_images_lang', function(Blueprint $table) {
            $table->foreign('image_id', 'specialists_images_lang_1')->references('id')->on('specialists_images')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_units_rel_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->text('name')->nullable();
        });

        Schema::create('specialists_units_relations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('sort_order')->default(0);
            $table->integer('specialist_id')->unsigned()->index();
            $table->integer('unit_id')->nullable()->index()->unsigned();
            $table->integer('rel_type_id')->nullable()->index()->unsigned();
        });

        Schema::table('specialists_units_relations', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_units_relations_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('unit_id', 'specialists_units_relations_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('rel_type_id', 'specialists_units_relations_3')->references('id')->on('specialists_units_rel_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_units_cats_rel_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->text('name')->nullable();
        });

        Schema::create('specialists_units_cats_relations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('specialist_id')->unsigned()->index();
            $table->integer('cat_id')->nullable()->index()->unsigned();
            $table->integer('rel_type_id')->nullable()->index()->unsigned();
        });

        Schema::table('specialists_units_cats_relations', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_units_cats_relations_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'specialists_units_cats_relations_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('rel_type_id', 'specialists_units_cats_relations_3')->references('id')->on('specialists_units_cats_rel_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        if (class_exists(\Demos\Market\MarketServiceProvider::class)) {

            Schema::create('specialists_goods_rel_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('sort_order')->default(0);
                $table->text('name')->nullable();
            });

            Schema::create('specialists_goods_relations', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('sort_order')->default(0);
                $table->integer('specialist_id')->unsigned()->index();
                $table->integer('good_id')->nullable()->index()->unsigned();
                $table->integer('rel_type_id')->nullable()->index()->unsigned();
            });

            Schema::table('specialists_goods_relations', function(Blueprint $table) {
                $table->foreign('specialist_id', 'specialists_goods_relations_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign('good_id', 'specialists_goods_relations_2')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign('rel_type_id', 'specialists_goods_relations_3')->references('id')->on('specialists_goods_rel_types')->onUpdate('CASCADE')->onDelete('CASCADE');
            });

            Schema::create('specialists_market_cats_rel_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('sort_order')->default(0);
                $table->text('name')->nullable();
            });

            Schema::create('specialists_market_cats_relations', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('specialist_id')->unsigned()->index();
                $table->integer('cat_id')->nullable()->index()->unsigned();
                $table->integer('rel_type_id')->nullable()->index()->unsigned();
            });

            Schema::table('specialists_market_cats_relations', function(Blueprint $table) {
                $table->foreign('specialist_id', 'specialists_market_cats_relations_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign('cat_id', 'specialists_market_cats_relations_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign('rel_type_id', 'specialists_market_cats_relations_3')->references('id')->on('specialists_market_cats_rel_types')->onUpdate('CASCADE')->onDelete('CASCADE');
            });
        }

        Schema::create('specialists_chars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->text('name')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('specialists_chars_vals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->text('value')->nullable();
            $table->integer('char_id')->unsigned()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('specialists_chars_vals', function(Blueprint $table) {
            $table->foreign('char_id', 'specialists_chars_vals_1')->references('id')->on('specialists_chars')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_chars_relations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('specialist_id')->unsigned()->index();
            $table->integer('char_id')->nullable()->index()->unsigned();
            $table->integer('val_id')->nullable()->index()->unsigned();
            $table->text('own_value')->nullable();
        });

        Schema::table('specialists_chars_relations', function(Blueprint $table) {
            $table->foreign('specialist_id', 'specialists_chars_relations_1')->references('id')->on('specialists')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('char_id', 'specialists_chars_relations_2')->references('id')->on('specialists_chars')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('val_id', 'specialists_chars_relations_3')->references('id')->on('specialists_chars_vals')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('specialists_params', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('images_group_1_name')->nullable();
            $table->text('images_group_2_name')->nullable();
            $table->string('mini_aspect_gallery', 255)->default('1:1');
            $table->string('small_aspect_gallery', 255)->default('4:3');
            $table->string('thumb_aspect_gallery', 255)->default('4:3');
            $table->string('big_width_gallery', 255)->default('2000');
            $table->string('small_width_gallery', 255)->default('500');
            $table->string('thumb_width_gallery', 255)->default('200');
            $table->string('mini_width_gallery', 255)->default('100');
            $table->boolean('is_fill_gallery')->default(0);
            $table->string('mini_aspect_cover', 255)->default('1:1');
            $table->string('small_aspect_cover', 255)->default('4:3');
            $table->string('thumb_aspect_cover', 255)->default('4:3');
            $table->string('big_width_cover', 255)->default('2000');
            $table->string('small_width_cover', 255)->default('500');
            $table->string('thumb_width_cover', 255)->default('200');
            $table->string('mini_width_cover', 255)->default('100');
            $table->boolean('is_fill_cover')->default(0);
            $table->string('noimage_images', 255)->nullable();
            $table->string('noimage_covers', 255)->nullable();
        });

        DB::table('specialists_params')->insert(
            [
                'id' => 1,
                'images_group_1_name' => '{"ru":"\u0414\u0438\u043f\u043b\u043e\u043c\u044b \u0438 \u0441\u0435\u0440\u0442\u0438\u0444\u0438\u043a\u0430\u0442\u044b","uk":"\u0414\u0438\u043f\u043b\u043e\u043c\u0438 \u0442\u0430 \u0441\u0435\u0440\u0442\u0438\u0444\u0456\u043a\u0430\u0442\u0438"}',
                'images_group_2_name' => '{"ru":"\u041f\u043e\u0440\u0442\u0444\u043e\u043b\u0438\u043e","uk":"\u041f\u043e\u0440\u0442\u0444\u043e\u043b\u0456\u043e"}',
            ]
        );

        $folders = ['noimage/specialists','noimage/specialists/covers','noimage/specialists/covers/big','noimage/specialists/covers/small','noimage/specialists/covers/thumb','noimage/specialists/covers/mini','noimage/specialists/images','noimage/specialists/images/big','noimage/specialists/images/small','noimage/specialists/images/thumb','noimage/specialists/images/mini','specialists','specialists/covers','specialists/covers/big','specialists/covers/small','specialists/covers/thumb','specialists/covers/mini','specialists/images','specialists/images/big','specialists/images/small','specialists/images/thumb','specialists/images/mini'];


        foreach ($folders as $folder) {
            \Storage::disk('public')->makeDirectory($folder);
        }        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('specialists_chars_relations', function (Blueprint $table) {
            $table->dropForeign('specialists_chars_relations_1');
            $table->dropForeign('specialists_chars_relations_2');
            $table->dropForeign('specialists_chars_relations_3');
        });

        Schema::dropIfExists('specialists_chars_relations');

        Schema::table('specialists_chars_vals', function (Blueprint $table) {
            $table->dropForeign('specialists_chars_vals_1');
        });

        Schema::dropIfExists('specialists_chars_vals');
        Schema::dropIfExists('specialists_chars');

        if (class_exists(\Demos\Market\MarketServiceProvider::class)) {

            Schema::table('specialists_market_cats_relations', function (Blueprint $table) {
                $table->dropForeign('specialists_market_cats_relations_1');
                $table->dropForeign('specialists_market_cats_relations_2');
                $table->dropForeign('specialists_market_cats_relations_3');
            });
            Schema::dropIfExists('specialists_market_cats_relations');
            Schema::dropIfExists('specialists_market_cats_rel_types');


            Schema::table('specialists_goods_relations', function (Blueprint $table) {
                $table->dropForeign('specialists_goods_relations_1');
                $table->dropForeign('specialists_goods_relations_2');
                $table->dropForeign('specialists_goods_relations_3');
            });
            Schema::dropIfExists('specialists_goods_relations');
            Schema::dropIfExists('specialists_goods_rel_types');
        }

        Schema::table('specialists_units_cats_relations', function (Blueprint $table) {
            $table->dropForeign('specialists_units_cats_relations_1');
            $table->dropForeign('specialists_units_cats_relations_2');
            $table->dropForeign('specialists_units_cats_relations_3');
        });
        Schema::dropIfExists('specialists_units_cats_relations');
        Schema::dropIfExists('specialists_units_cats_rel_types');

        Schema::table('specialists_units_relations', function (Blueprint $table) {
            $table->dropForeign('specialists_units_relations_1');
            $table->dropForeign('specialists_units_relations_2');
            $table->dropForeign('specialists_units_relations_3');
        });
        Schema::dropIfExists('specialists_units_relations');
        Schema::dropIfExists('specialists_units_rel_types');

        Schema::table('specialists_images_lang', function (Blueprint $table) {
            $table->dropForeign('specialists_images_lang_1');
        });
        Schema::dropIfExists('specialists_images_lang');

        Schema::table('specialists_images', function (Blueprint $table) {
            $table->dropForeign('specialists_images_1');
        });
        Schema::dropIfExists('specialists_images');

        Schema::table('specialists_videos_lang', function (Blueprint $table) {
            $table->dropForeign('specialists_videos_lang_1');
        });
        Schema::dropIfExists('specialists_videos_lang');

        Schema::table('specialists_videos', function (Blueprint $table) {
            $table->dropForeign('specialists_videos_1');
        });
        Schema::dropIfExists('specialists_videos');

        Schema::table('specialists_files', function (Blueprint $table) {
            $table->dropForeign('specialists_files_1');
            $table->dropForeign('specialists_files_2');
        });
        Schema::dropIfExists('specialists_files');

        Schema::table('specialists_xp_lang', function (Blueprint $table) {
            $table->dropForeign('specialists_xp_lang_1');
        });
        Schema::dropIfExists('specialists_xp_lang');

        Schema::table('specialists_xp', function (Blueprint $table) {
            $table->dropForeign('specialists_xp_1');
        });
        Schema::dropIfExists('specialists_xp');

        Schema::table('specialists_lang', function (Blueprint $table) {
            $table->dropForeign('specialists_lang_1');
        });
        Schema::dropIfExists('specialists_lang');
        Schema::dropIfExists('specialists');
        Schema::dropIfExists('specialists_params');

        DB::table('sections')->whereIn('alias', ['specialists', 'specialists_list', 'specialists_params'])->delete();
    }
}
