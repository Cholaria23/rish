<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('sections')->insert([
            [
                'alias' => 'market',
                'lang_name' => 'Market::main.sections.market',
                'route' => 'admin.market.index',
            ]
        ]);

        $parent_id = DB::table('sections')->where('alias', 'market')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'market_categories',
                'lang_name' => 'Market::main.sections.categories',
                'route' => 'admin.market.categories',
                'parent_id' => $parent_id
            ],
            [
                'alias' => 'market_goods',
                'lang_name' => 'Market::main.sections.goods',
                'route' => 'admin.market.goods',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'market_chars',
                'lang_name' => 'Market::main.sections.chars',
                'route' => 'admin.market.chars',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'market_currs',
                'lang_name' => 'Market::main.sections.currs',
                'route' => 'admin.market.currs',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'market_params',
                'lang_name' => 'Market::main.sections.params',
                'route' => 'admin.market.params',
                'parent_id' => $parent_id,
            ],
                        [
                'alias' => 'market_catalog_params',
                'lang_name' => 'Market::main.sections.catalog_params',
                'route' => '',
                'parent_id' => $parent_id,
            ],
            [
                'alias' => 'market_trash',
                'lang_name' => 'Market::main.sections.trash',
                'route' => 'admin.market.trash',
                'parent_id' => $parent_id,
            ],
        ]);

        Schema::create('market_categories', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('parent_id')->nullable()->index()->unsigned();
            $table->string('alias', 255)->unique();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_price')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_hidden_menu')->default(1);
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
            $table->boolean('gal_settings_children')->default(0);
            $table->boolean('cov_settings_children')->default(0);
            $table->text('fields')->nullable();
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->string('goods_default_sort')->default('created_at_desc');
            $table->string('delivery_cost')->default(0);
            $table->string('delivery_min')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('market_categories_lang', function (Blueprint $table) {
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

        Schema::table('market_categories_lang', function(Blueprint $table) {
            $table->foreign('cat_id', 'market_categories_lang_1')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_categories_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('account_id')->nullable()->index()->unsigned();
            $table->string('field', 255)->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamps();
        });

        Schema::table('market_categories_logs', function(Blueprint $table) {
            $table->foreign('cat_id', 'market_categories_logs_1')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_categories_files', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('file_id')->nullable()->index()->unsigned();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('market_categories_files', function(Blueprint $table) {
            $table->foreign('cat_id', 'market_categories_files_1')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('file_id', 'market_categories_files_2')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_goods', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('cat_id')->unsigned()->index();
            $table->string('alias', 255)->unique();
            $table->integer('sort_order')->default(0);
            $table->string('article', 255)->index()->nullable();
            $table->string('code', 255)->index()->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('visitors')->default(0);
            $table->integer('min_count')->default(0);
            $table->integer('remains')->default(0);
            $table->boolean('is_set')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_top')->default(0);
            $table->boolean('is_new')->default(0);
            $table->boolean('is_archive')->default(0);
            $table->boolean('is_noindex')->default(0);
            $table->boolean('is_online')->default(0);
            $table->boolean('spec_option_1')->default(0);
            $table->boolean('spec_option_2')->default(0);
            $table->boolean('spec_option_3')->default(0);
            $table->text('svg')->nullable();
            $table->string('img_1', 255)->nullable();
            $table->string('img_2', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_goods', function(Blueprint $table) {
            $table->foreign('cat_id', 'market_goods_1')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_goods_rel_types', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_undeletable')->default(0);
            $table->string('name', 255)->nullable();
        });

        DB::table('market_goods_rel_types')->insert([
            ['is_undeletable' => 1, 'name' => "direct"],
        ]);

        Schema::create('market_goods_relations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('sort_order')->default(0);
            $table->integer('good_id')->unsigned()->index();
            $table->integer('related_id')->nullable()->index()->unsigned();
            $table->integer('rel_type_id')->nullable()->index()->unsigned();
        });

        Schema::table('market_goods_relations', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_relations_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('related_id', 'market_goods_relations_2')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('rel_type_id', 'market_goods_relations_3')->references('id')->on('market_goods_rel_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_goods_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
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

        Schema::table('market_goods_lang', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_lang_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_goods_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
            $table->integer('account_id')->nullable()->index()->unsigned();
            $table->string('field', 255)->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamps();
        });

        Schema::table('market_goods_logs', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_logs_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_cats_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        }); 

        Schema::table('market_cats_relations', function(Blueprint $table) {
            $table->foreign('good_id', 'market_cats_relations_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'market_cats_relations_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_chars_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255)->unique();
			$table->softDeletes();
            $table->timestamps();
        });

        Schema::create('market_chars_groups_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
        });

        Schema::table('market_chars_groups_lang', function(Blueprint $table) {
            $table->foreign('group_id', 'market_chars_groups_lang_1')->references('id')->on('market_chars_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('market_chars_groups')->insert(
            [
                'alias' => "default",
            ]
        );

        DB::table('market_chars_groups_lang')->insert(
            [
                'group_id' => 1,
                'lang' => "ru",
                'name' => "Нераспределенные характеристики",
                'description' => "Неудаляемая группа по умолчанию",
            ]
        );

        Schema::create('market_chars_groups_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('market_chars_groups_categories', function(Blueprint $table) {
            $table->foreign('group_id', 'market_chars_groups_categories_1')->references('id')->on('market_chars_groups')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('cat_id', 'market_chars_groups_categories_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_chars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index()->default(1);
            $table->string('alias', 255)->unique();
            $table->integer('sort_order')->default(0);
            $table->text('icon_svg')->nullable();
            $table->string('icon_img', 255)->nullable();
            $table->string('add_name', 255)->nullable();
            $table->boolean('is_multiple')->default(0);
            $table->boolean('is_numeric')->default(0);
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_chars', function(Blueprint $table) {
            $table->foreign('group_id', 'market_chars_1')->references('id')->on('market_chars_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_chars_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('char_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('prefix', 255)->nullable();
            $table->string('suffix', 255)->nullable();
        });

        Schema::table('market_chars_lang', function(Blueprint $table) {
            $table->foreign('char_id', 'market_chars_lang_1')->references('id')->on('market_chars')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_chars_vals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('char_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->string('value', 255)->nullable();
            $table->text('icon_svg')->nullable();
            $table->string('icon_img', 255)->nullable();
            $table->integer('created_by')->nullable()->index()->unsigned();
            $table->integer('deleted_by')->nullable()->index()->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('market_chars_vals', function(Blueprint $table) {
            $table->foreign('char_id', 'market_chars_vals_1')->references('id')->on('market_chars')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_chars_vals_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('char_val_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('lang_value', 255)->nullable();
            $table->text('description')->nullable();
        });

        Schema::table('market_chars_vals_lang', function(Blueprint $table) {
            $table->foreign('char_val_id', 'market_chars_vals_lang_1')->references('id')->on('market_chars_vals')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_chars_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('char_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
            $table->boolean('is_char')->default(0);
            $table->boolean('is_filter')->default(0);
            $table->boolean('is_in_list')->default(0);
            $table->integer('sort_order')->default(0);
        });

        Schema::table('market_chars_categories', function(Blueprint $table) {
            $table->foreign('char_id', 'market_chars_categories_1')->references('id')->on('market_chars')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('cat_id', 'market_chars_categories_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_chars_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
            $table->integer('char_id')->unsigned()->index();
            $table->integer('char_val_id')->unsigned()->index()->nullable();
            $table->string('own_value', 255)->nullable();
        });

        Schema::table('market_chars_relations', function(Blueprint $table) {
            $table->foreign('char_id', 'market_chars_relations_1')->references('id')->on('market_chars')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('good_id', 'market_chars_relations_2')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('char_val_id', 'market_chars_relations_3')->references('id')->on('market_chars_vals')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_params', function (Blueprint $table) {
            $table->increments('id');
            $table->string('good_url_prefix', 255)->nullable();
            $table->string('cat_url_prefix', 255)->nullable();
            $table->string('market_cat_spec_option_1_name', 255)->nullable();
            $table->string('market_cat_spec_option_2_name', 255)->nullable();
            $table->string('market_cat_spec_option_3_name', 255)->nullable();
            $table->string('market_good_spec_option_1_name', 255)->nullable();
            $table->string('market_good_spec_option_2_name', 255)->nullable();
            $table->string('market_good_spec_option_3_name', 255)->nullable();
            $table->string('noimage_market_goods', 255)->nullable();
            $table->string('noimage_market_cats', 255)->nullable();
            $table->boolean('is_show_empty_price')->default(1);
        });

        DB::table('market_params')->insert(
            [
                'id' => 1
            ]
        );

        Schema::create('market_accounts_params', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index()->nullable();
            $table->boolean('is_good_blank')->default(1);
            $table->boolean('is_edit_new_good')->default(1);
            $table->integer('icon_size')->default(1);
            $table->boolean('is_list_cover')->default(1);
            $table->boolean('is_list_name')->default(1);
            $table->boolean('is_list_alias')->default(1);
            $table->boolean('is_list_article')->default(1);
            $table->boolean('is_list_top')->default(1);
            $table->boolean('is_list_new')->default(1);
            $table->boolean('is_list_archive')->default(1);
            $table->boolean('is_list_hidden')->default(1);
            $table->boolean('is_list_online')->default(1);
            $table->boolean('is_list_created_at')->default(1);
            $table->boolean('is_list_updated_at')->default(1);
            $table->boolean('is_list_code')->default(1);
            $table->boolean('is_list_price')->default(1);
            $table->boolean('is_list_remains')->default(1);
            $table->boolean('is_list_chars')->default(1);
            $table->boolean('is_list_hot_name')->default(1);
            $table->boolean('is_list_hot_alias')->default(1);
            $table->boolean('is_list_hot_article')->default(1);
            $table->boolean('is_list_hot_code')->default(1);
            $table->boolean('is_list_hot_price')->default(1);
            $table->boolean('is_list_hot_ramains')->default(1);
            $table->boolean('is_list_hot_chars')->default(1);
        });

        Schema::table('market_accounts_params', function(Blueprint $table) {
            $table->foreign('account_id', 'market_accounts_params_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
        });


        Schema::create('market_currs', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->string('alias', 255)->unique();
            $table->string('num_code', 255)->nullable();
            $table->string('iso_code', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_main')->default(0);
            $table->boolean('is_default')->default(0);
            $table->boolean('is_hidden')->default(1);
            $table->boolean('is_yml_show')->default(1);
            $table->float('rate',8,2)->default(1);
            $table->datetime('actualy_date')->nullable();  
            $table->string('sign', 255)->nullable();          
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('market_currs_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curr_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('short_name', 255)->nullable();
        });

        Schema::table('market_currs_lang', function(Blueprint $table) {
            $table->foreign('curr_id', 'market_currs_lang_1')->references('id')->on('market_currs')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        DB::table('market_currs')->insert([
            [
                'alias' => "uah",
                'sort_order' => 0,
                'is_main' => 1,
                'is_default' => 1,
                'is_hidden' => 0,
                'is_yml_show' => 1,
                'rate' => 1,
                'iso_code' => 980,
                'sign' => "₴",
            ],
            [
                'alias' => "usd",
                'sort_order' => 1,
                'is_main' => 0,
                'is_default' => 0,
                'is_hidden' => 0,
                'is_yml_show' => 1,
                'rate' => 1,
                'iso_code' => 840,
                'sign' => "$",
            ],
            [
                'alias' => "eur",
                'sort_order' => 2,
                'is_main' => 0,
                'is_default' => 0,
                'is_hidden' => 0,
                'is_yml_show' => 1,
                'rate' => 1,
                'iso_code' => 978,
                'sign' => "€",
            ],
        ]);
        DB::table('market_currs_lang')->insert([
            [
                'curr_id' => 1,
                'lang' => "ru",
                'name' => "Украинская гривна",
                'short_name' => "грн"
            ],
            [
                'curr_id' => 2,
                'lang' => "ru",
                'name' => "Доллар США",
                'short_name' => "дол",
            ],
            [
                'curr_id' => 3,
                'lang' => "ru",
                'name' => "Евро",
                'short_name' => "евро"
            ],
        ]);

        Schema::create('market_price_types', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->string('alias', 255)->unique();
            $table->string('name', 255)->nullable();
            $table->boolean('is_main')->default(0);
            $table->boolean('is_action')->default(0);
            $table->softDeletes();
            $table->timestamps();         
        });

        DB::table('market_price_types')->insert([
            [
                'alias' => "default",
                'name' => "Основная",
                'is_main' => 1,
                'is_action' => 0,
            ],
            [
                'alias' => "sale",
                'name' => "Акционная",
                'is_main' => 0,
                'is_action' => 1,
            ],
        ]);

        Schema::create('market_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curr_id')->unsigned()->index();
            $table->integer('good_id')->unsigned()->index();
            $table->integer('price_type_id')->unsigned()->index();
            $table->float('value',8,2)->nullable();
            $table->string('string_value',255)->nullable();
            $table->float('value_min',8,2)->nullable();
            $table->float('value_max',8,2)->nullable();
            $table->datetime('date_start')->nullable(); 
            $table->datetime('date_end')->nullable(); 
        });

        Schema::table('market_prices', function(Blueprint $table) {
            $table->foreign('curr_id', 'market_prices_1')->references('id')->on('market_currs')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('price_type_id', 'market_prices_2')->references('id')->on('market_price_types')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('good_id', 'market_prices_3')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('market_categories_accounts_edit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
        }); 

        Schema::table('market_categories_accounts_edit', function(Blueprint $table) {
            $table->foreign('account_id', 'market_categories_accounts_edit_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'market_categories_accounts_edit_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });


        Schema::create('market_categories_accounts_fill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
        }); 

        Schema::table('market_categories_accounts_fill', function(Blueprint $table) {
            $table->foreign('account_id', 'market_categories_accounts_fill_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'market_categories_accounts_fill_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('market_categories_accounts_favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
        }); 

        Schema::table('market_categories_accounts_favorite', function(Blueprint $table) {
            $table->foreign('account_id', 'market_categories_accounts_favorite_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'market_categories_accounts_favorite_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('leads', function(Blueprint $table) {
            $table->integer('good_id')->unsigned()->index()->nullable();
            $table->integer('market_cat_id')->unsigned()->index()->nullable();
            $table->foreign('good_id', 'leads_6')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('market_cat_id', 'leads_7')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('units_market_cats_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('cat_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
        });
        Schema::table('units_market_cats_relations', function(Blueprint $table) {
            $table->foreign('unit_id', 'units_market_cats_relations_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('cat_id', 'units_market_cats_relations_2')->references('id')->on('market_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        Schema::create('units_goods_relations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('sort_order')->default(0);
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('good_id')->nullable()->index()->unsigned();
        });
        Schema::table('units_goods_relations', function(Blueprint $table) {
            $table->foreign('unit_id', 'units_goods_relations_1')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('good_id', 'units_goods_relations_2')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
        });  

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_cats_relations', function (Blueprint $table) {
            $table->dropForeign('market_cats_relations_1');
            $table->dropForeign('market_cats_relations_2');
        });
        Schema::dropIfExists('market_cats_relations');

        Schema::table('units_market_cats_relations', function (Blueprint $table) {
            $table->dropForeign('units_market_cats_relations_1');
            $table->dropForeign('units_market_cats_relations_2');
        });       
        Schema::table('units_goods_relations', function (Blueprint $table) {
            $table->dropForeign('units_goods_relations_1');
            $table->dropForeign('units_goods_relations_2');
        });
        Schema::dropIfExists('units_goods_relations');
        Schema::dropIfExists('units_market_cats_relations');
        
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign('leads_6');
            $table->dropForeign('leads_7');
            $table->dropColumn("good_id");
            $table->dropColumn("market_cat_id");
        });
        
        DB::table('sections')->where('alias', 'market')->delete();        

        Schema::dropIfExists('market_params');
        
        Schema::table('market_accounts_params', function (Blueprint $table) {
            $table->dropForeign('market_accounts_params_1');
        });
        Schema::dropIfExists('market_accounts_params');
        
        Schema::table('market_categories_files', function (Blueprint $table) {
            $table->dropForeign('market_categories_files_1');
            $table->dropForeign('market_categories_files_2');
        });
        Schema::dropIfExists('market_categories_files');

        Schema::table('market_categories_accounts_edit', function (Blueprint $table) {
            $table->dropForeign('market_categories_accounts_edit_1');
            $table->dropForeign('market_categories_accounts_edit_2');
        });
        Schema::dropIfExists('market_categories_accounts_edit');

        Schema::table('market_categories_accounts_fill', function (Blueprint $table) {
            $table->dropForeign('market_categories_accounts_fill_1');
            $table->dropForeign('market_categories_accounts_fill_2');
        });
        Schema::dropIfExists('market_categories_accounts_fill');

        Schema::table('market_categories_accounts_favorite', function (Blueprint $table) {
            $table->dropForeign('market_categories_accounts_favorite_1');
            $table->dropForeign('market_categories_accounts_favorite_2');
        });  
        Schema::dropIfExists('market_categories_accounts_favorite'); 

        Schema::table('market_prices', function (Blueprint $table) {
            $table->dropForeign('market_prices_1');
            $table->dropForeign('market_prices_2');
            $table->dropForeign('market_prices_3');
        });
        Schema::dropIfExists('market_prices');

        Schema::table('market_currs_lang', function (Blueprint $table) {
            $table->dropForeign('market_currs_lang_1');
        });
        Schema::dropIfExists('market_currs_lang');
        Schema::dropIfExists('market_currs');        
        Schema::dropIfExists('market_price_types');

        Schema::table('market_chars_categories', function (Blueprint $table) {
            $table->dropForeign('market_chars_categories_1');
            $table->dropForeign('market_chars_categories_2');
        });
        Schema::dropIfExists('market_chars_categories');

        Schema::table('market_chars_relations', function (Blueprint $table) {
            $table->dropForeign('market_chars_relations_1');
            $table->dropForeign('market_chars_relations_2');
            $table->dropForeign('market_chars_relations_3');
        });
        Schema::dropIfExists('market_chars_relations');

        Schema::table('market_chars_vals_lang', function (Blueprint $table) {
            $table->dropForeign('market_chars_vals_lang_1');
        });
        Schema::dropIfExists('market_chars_vals_lang');

        Schema::table('market_chars_vals', function (Blueprint $table) {
            $table->dropForeign('market_chars_vals_1');
        });
        Schema::dropIfExists('market_chars_vals');

        Schema::table('market_chars_lang', function (Blueprint $table) {
            $table->dropForeign('market_chars_lang_1');
        });
        Schema::dropIfExists('market_chars_lang');

        Schema::table('market_chars', function (Blueprint $table) {
            $table->dropForeign('market_chars_1');
        });
        Schema::dropIfExists('market_chars');

        Schema::table('market_chars_groups_lang', function (Blueprint $table) {
            $table->dropForeign('market_chars_groups_lang_1');
        });
        Schema::dropIfExists('market_chars_groups_lang');

        Schema::table('market_chars_groups_categories', function (Blueprint $table) {
            $table->dropForeign('market_chars_groups_categories_1');
            $table->dropForeign('market_chars_groups_categories_2');
        });
        Schema::dropIfExists('market_chars_groups_categories');       

        Schema::dropIfExists('market_chars_groups');

        Schema::table('market_goods_logs', function (Blueprint $table) {
            $table->dropForeign('market_goods_logs_1');
        });
        Schema::dropIfExists('market_goods_logs');

        Schema::table('market_goods_lang', function (Blueprint $table) {
            $table->dropForeign('market_goods_lang_1');
        });
        Schema::dropIfExists('market_goods_lang');
        Schema::table('market_goods', function (Blueprint $table) {
            $table->dropForeign('market_goods_1');
        });


        Schema::table('market_goods_relations', function (Blueprint $table) {
            $table->dropForeign('market_goods_relations_1');
            $table->dropForeign('market_goods_relations_2');
            $table->dropForeign('market_goods_relations_3');
        });

        Schema::dropIfExists('market_goods_relations');
        Schema::dropIfExists('market_goods_rel_types');


        Schema::dropIfExists('market_goods');

        Schema::table('market_categories_logs', function (Blueprint $table) {
            $table->dropForeign('market_categories_logs_1');
        });

        Schema::dropIfExists('market_categories_logs');
        Schema::table('market_categories_lang', function (Blueprint $table) {
            $table->dropForeign('market_categories_lang_1');
        });
        Schema::dropIfExists('market_categories_lang');
        Schema::dropIfExists('market_categories');
    }
}
