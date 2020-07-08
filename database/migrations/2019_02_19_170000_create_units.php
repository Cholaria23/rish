<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnits extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        DB::table('sections')->insert([
            [
                'alias' => 'units',
                'lang_name' => 'AdminPanel::main.sections.units',
                'route' => 'admin.units.index',
            ]
        ]);

        $parent_id = DB::table('sections')->where('alias', 'units')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'edit_units_categories',
                'lang_name' => 'AdminPanel::main.sections.edit_units_categories',
                'route' => 'admin.units.categories',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'edit_units',
                'lang_name' => 'AdminPanel::main.sections.edit_units',
                'route' => 'admin.units.units',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'units_chars',
                'lang_name' => 'AdminPanel::main.sections.units_chars',
                'route' => 'admin.units.chars',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'units_galleries',
                'lang_name' => 'AdminPanel::main.sections.units_galleries',
                'route' => 'admin.units.galleries',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'units_params',
                'lang_name' => 'AdminPanel::main.sections.units_params',
                'route' => 'admin.units.params',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'units_trash',
                'lang_name' => 'AdminPanel::main.sections.units_trash',
                'route' => 'admin.units.trash',
                'parent_id' => $parent_id,
            ],
        ]);

        Schema::create('units_params', function (Blueprint $table) {
            $table->increments('id');
            $table->string('noimage_cats', 255)->nullable();
            $table->string('noimage_units', 255)->nullable();
            $table->string('cat_spec_option_1_name', 255)->nullable();
            $table->string('cat_spec_option_2_name', 255)->nullable();
            $table->string('cat_spec_option_3_name', 255)->nullable();
            $table->string('unit_spec_option_1_name', 255)->nullable();
            $table->string('unit_spec_option_2_name', 255)->nullable();
            $table->string('unit_spec_option_3_name', 255)->nullable();
        });

        DB::table('units_params')->insert(
            [
                'cat_spec_option_1_name' => 'Признак 1',
                'cat_spec_option_2_name' => 'Признак 2',
                'cat_spec_option_3_name' => 'Признак 3',
                'unit_spec_option_1_name' => 'Признак 1',
                'unit_spec_option_2_name' => 'Признак 2',
                'unit_spec_option_3_name' => 'Признак 3',
            ]
        );

        Schema::create('units_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->index()->unsigned();
            $table->string('alias', 255)->unique();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_hidden_bc')->default(0);
            $table->boolean('is_undeletable')->default(1);
            $table->boolean('is_noindex')->default(0);
            $table->boolean('spec_option_1')->default(0);
            $table->boolean('spec_option_2')->default(0);
            $table->boolean('spec_option_3')->default(0);
            $table->integer('pages_count')->default(20);
            $table->text('cover_svg')->nullable();
            $table->string('cover_1_img', 255)->nullable();
            $table->string('cover_2_img', 255)->nullable();
            $table->string('background_img', 255)->nullable();
            $table->string('small_aspect_cover', 255)->default('4:3');
            $table->string('thumb_aspect_cover', 255)->default('4:3');
            $table->string('big_width_cover', 255)->default('2000');
            $table->string('small_width_cover', 255)->default('500');
            $table->string('thumb_width_cover', 255)->default('200');
            $table->boolean('is_fill_cover')->default(0);
            $table->boolean('cov_settings_children')->default(0);
            $table->text('fields')->nullable();
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('units_categories', function(Blueprint $table) {
            $table->foreign('parent_id', 'units_categories_parent_id')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('units_categories_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('pre_info')->nullable();
            $table->text('post_info')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_key', 255)->nullable();
            $table->text('meta_desc')->nullable();
        });

        Schema::table('units_categories_lang', function(Blueprint $table) {
            $table->foreign('cat_id', 'units_categories_lang_1')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('units_categories')->insert([
            ['alias' => "html", 'is_hidden' => 0,],
            ['alias' => "news", 'is_hidden' => 0,],
            ['alias' => "articles", 'is_hidden' => 0,],
        ]);

        DB::table('units_categories_lang')->insert([
            ['cat_id' => 1, 'lang' => "ru", 'name' => "HTML",],
            ['cat_id' => 2, 'lang' => "ru", 'name' => "Новости",],
            ['cat_id' => 3, 'lang' => "ru", 'name' => "Статьи",],
            ['cat_id' => 1, 'lang' => "uk", 'name' => "HTML",],
            ['cat_id' => 2, 'lang' => "uk", 'name' => "Новини",],
            ['cat_id' => 3, 'lang' => "uk", 'name' => "Статті",],
            ['cat_id' => 1, 'lang' => "en", 'name' => "HTML",],
            ['cat_id' => 2, 'lang' => "en", 'name' => "News",],
            ['cat_id' => 3, 'lang' => "en", 'name' => "Articles",],
        ]);

        Schema::create('units_categories_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('account_id')->nullable()->index()->unsigned();
            $table->string('field', 255)->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamps();
        });

        Schema::table('units_categories_logs', function(Blueprint $table) {
            $table->foreign('cat_id', 'units_categories_logs_1')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units_categories_accounts_edit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
        }); 

        Schema::table('units_categories_accounts_edit', function(Blueprint $table) {
            $table->foreign('account_id', 'units_categories_accounts_edit_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'units_categories_accounts_edit_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units_categories_accounts_fill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
        }); 

        Schema::table('units_categories_accounts_fill', function(Blueprint $table) {
            $table->foreign('account_id', 'units_categories_accounts_fill_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'units_categories_accounts_fill_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units_categories_accounts_favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
        }); 

        Schema::table('units_categories_accounts_favorite', function(Blueprint $table) {
            $table->foreign('account_id', 'units_categories_accounts_favorite_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'units_categories_accounts_favorite_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('cat_id')->unsigned()->index();
            $table->string('alias', 255)->unique();
            $table->integer('sort_order')->default(0);
            $table->integer('visitors')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_top')->default(0);
            $table->boolean('is_archive')->default(0);
            $table->boolean('is_noindex')->default(0);
            $table->boolean('spec_option_1')->default(0);
            $table->boolean('spec_option_2')->default(0);
            $table->boolean('spec_option_3')->default(0);
            $table->text('svg')->nullable();
            $table->string('img_1', 255)->nullable();
            $table->string('img_2', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->boolean('is_period')->default(0);
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();            
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('units', function(Blueprint $table) {
            $table->foreign('cat_id', 'units_1')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('short_desc_1')->nullable();
            $table->text('short_desc_2')->nullable();
            $table->text('long_desc_1')->nullable();
            $table->text('long_desc_2')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_key', 255)->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('tags')->nullable();
        });

        Schema::table('units_lang', function(Blueprint $table) {
            $table->foreign('unit_id', 'units_lang_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        
        Schema::create('units_cats_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        }); 

        Schema::table('units_cats_relations', function(Blueprint $table) {
            $table->foreign('unit_id', 'units_cats_relations_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'units_cats_relations_2')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('units')->insert([
            ['alias' => "main", 'is_hidden' => 0, 'sort_order' => 5, 'cat_id' => 1],
            ['alias' => "contacts", 'is_hidden' => 0, 'sort_order' => 4, 'cat_id' => 1],
            ['alias' => "about_us", 'is_hidden' => 0, 'sort_order' => 3, 'cat_id' => 1],
            ['alias' => "about_cookie", 'is_hidden' => 0, 'sort_order' => 2, 'cat_id' => 1],
            ['alias' => "success", 'is_hidden' => 0, 'sort_order' => 1, 'cat_id' => 1],
        ]);

        DB::table('units_lang')->insert([
            ['unit_id' => 1, 'lang' => "ru", 'name' => "Главная",],
            ['unit_id' => 2, 'lang' => "ru", 'name' => "Контакты",],
            ['unit_id' => 3, 'lang' => "ru", 'name' => "О нас",],
            ['unit_id' => 4, 'lang' => "ru", 'name' => "Наша политика в отношении cookie-файлов",],
            ['unit_id' => 5, 'lang' => "ru", 'name' => "Посадочная страница обратной связи",],
            ['unit_id' => 1, 'lang' => "uk", 'name' => "Головна",],
            ['unit_id' => 2, 'lang' => "uk", 'name' => "Контакти",],
            ['unit_id' => 3, 'lang' => "uk", 'name' => "Про нас",],
            ['unit_id' => 4, 'lang' => "uk", 'name' => "Наша політика щодо cookie-файлів",],
            ['unit_id' => 5, 'lang' => "uk", 'name' => "Посадкова сторінка зворотнього зв'язку",],
            ['unit_id' => 1, 'lang' => "en", 'name' => "Home",],
            ['unit_id' => 2, 'lang' => "en", 'name' => "Contacts",],
            ['unit_id' => 3, 'lang' => "en", 'name' => "About Us",],
            ['unit_id' => 4, 'lang' => "en", 'name' => "Our cookie policy",],
            ['unit_id' => 5, 'lang' => "en", 'name' => "Feedback Landing Page",],
        ]);

        Schema::create('units_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('account_id')->nullable()->index()->unsigned();
            $table->string('field', 255)->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamps();
        });

        Schema::table('units_logs', function(Blueprint $table) {
            $table->foreign('unit_id', 'units_logs_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units_rel_types', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_undeletable')->default(0);
            $table->string('name', 255)->nullable();
        });

        DB::table('units_rel_types')->insert([
            ['is_undeletable' => 1, 'name' => "direct"],
        ]);

        Schema::create('units_relations', function (Blueprint $table) {
        	$table->increments('id')->unsigned();
			$table->integer('sort_order')->default(0);
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('related_id')->nullable()->index()->unsigned();
            $table->integer('rel_type_id')->nullable()->index()->unsigned();
        });

        Schema::table('units_relations', function(Blueprint $table) {
            $table->foreign('unit_id', 'units_relations_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('related_id', 'units_relations_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('rel_type_id', 'units_relations_3')->references('id')->on('units_rel_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units_files', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('file_id')->nullable()->index()->unsigned();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('units_files', function(Blueprint $table) {
            $table->foreign('unit_id', 'units_files_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('file_id', 'units_files_2')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units_categories_files', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('file_id')->nullable()->index()->unsigned();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('units_categories_files', function(Blueprint $table) {
            $table->foreign('cat_id', 'units_categories_files_1')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('file_id', 'units_categories_files_2')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('units_chars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255)->unique();
            $table->integer('sort_order')->default(0);
            $table->text('icon_svg')->nullable();
            $table->string('icon_img', 255)->nullable();
            $table->boolean('is_char')->default(0);
            $table->boolean('is_filter')->default(0);
            $table->boolean('is_in_list')->default(0);
            $table->boolean('is_multiple')->default(0);
            $table->boolean('is_numeric')->default(0);
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('units_chars_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('char_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('prefix', 255)->nullable();
            $table->string('suffix', 255)->nullable();
        });

        Schema::table('units_chars_lang', function(Blueprint $table) {
            $table->foreign('char_id', 'units_chars_lang_1')->references('id')->on('units_chars')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('units_chars_vals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('char_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->string('value', 255)->nullable();
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('units_chars_vals', function(Blueprint $table) {
            $table->foreign('char_id', 'units_chars_vals_1')->references('id')->on('units_chars')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('units_chars_vals_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('char_val_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('lang_value', 255)->nullable();
        });

        Schema::table('units_chars_vals_lang', function(Blueprint $table) {
            $table->foreign('char_val_id', 'units_chars_vals_lang_1')->references('id')->on('units_chars_vals')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('units_chars_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('char_id')->unsigned()->index();
            $table->integer('char_val_id')->unsigned()->index()->nullable();
            $table->string('own_value', 255)->nullable();
        });

        Schema::table('units_chars_relations', function(Blueprint $table) {
            $table->foreign('char_id', 'units_chars_relations_1')->references('id')->on('units_chars')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('unit_id', 'units_chars_relations_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('char_val_id', 'units_chars_relations_3')->references('id')->on('units_chars_vals')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('units_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->index();
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

        Schema::table('units_videos', function(Blueprint $table) {
            $table->foreign('unit_id', 'units_videos_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('units_videos_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description_1', 255)->nullable();
            $table->string('description_2', 255)->nullable();
        });

        Schema::table('units_videos_lang', function(Blueprint $table) {
            $table->foreign('video_id', 'units_videos_lang_1')->references('id')->on('units_videos')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_videos_lang', function (Blueprint $table) {
            $table->dropForeign('units_videos_lang_1');
        });

        Schema::table('units_videos', function (Blueprint $table) {
            $table->dropForeign('units_videos_1');
        });
        Schema::dropIfExists('units_videos_lang');
        Schema::dropIfExists('units_videos');

        Schema::table('units_chars_vals_lang', function (Blueprint $table) {
            $table->dropForeign('units_chars_vals_lang_1');
        });

        Schema::dropIfExists('units_chars_relations');
        Schema::dropIfExists('units_chars_vals_lang');
        Schema::dropIfExists('units_chars_vals');
        Schema::dropIfExists('units_chars_lang');
        Schema::dropIfExists('units_chars');

        Schema::table('units_cats_relations', function (Blueprint $table) {
            $table->dropForeign('units_cats_relations_1');
            $table->dropForeign('units_cats_relations_2');
        });

        Schema::table('units_categories_accounts_edit', function (Blueprint $table) {
            $table->dropForeign('units_categories_accounts_edit_1');
            $table->dropForeign('units_categories_accounts_edit_2');
        });

        Schema::table('units_categories_accounts_fill', function (Blueprint $table) {
            $table->dropForeign('units_categories_accounts_fill_1');
            $table->dropForeign('units_categories_accounts_fill_2');
        });

        Schema::table('units_categories_accounts_favorite', function (Blueprint $table) {
            $table->dropForeign('units_categories_accounts_favorite_1');
            $table->dropForeign('units_categories_accounts_favorite_2');
        });

        Schema::table('units_categories', function (Blueprint $table) {
            $table->dropForeign('units_categories_parent_id');
        });

        Schema::table('units_categories_lang', function (Blueprint $table) {
            $table->dropForeign('units_categories_lang_1');
        });

        Schema::table('units_categories_logs', function (Blueprint $table) {
            $table->dropForeign('units_categories_logs_1');
        });

        Schema::table('units_files', function (Blueprint $table) {
            $table->dropForeign('units_files_1');
            $table->dropForeign('units_files_2');
        });

        Schema::table('units_categories_files', function (Blueprint $table) {
            $table->dropForeign('units_categories_files_1');
            $table->dropForeign('units_categories_files_2');
        });
        Schema::dropIfExists('units_categories_files');

        Schema::table('units_relations', function (Blueprint $table) {
            $table->dropForeign('units_relations_1');
            $table->dropForeign('units_relations_2');
            $table->dropForeign('units_relations_3');
        });

        Schema::dropIfExists('units_relations');
        Schema::dropIfExists('units_rel_types');

        Schema::dropIfExists('units_cats_relations');
        Schema::dropIfExists('units_files');
        Schema::dropIfExists('units_logs');
        Schema::dropIfExists('units_lang');
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign('units_1');
        });
        Schema::dropIfExists('units');

        Schema::dropIfExists('units_categories_accounts_edit');
        Schema::dropIfExists('units_categories_accounts_fill');
        Schema::dropIfExists('units_categories_accounts_favorite');        
        Schema::dropIfExists('units_categories_lang');
        Schema::dropIfExists('units_categories_logs');        
        Schema::dropIfExists('units_categories');
        Schema::dropIfExists('units_params');
        DB::table('sections')->where('alias', 'units')->delete();
    }
}
