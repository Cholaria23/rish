<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitAdminPanel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_banned')->default(0);
            $table->string('login')->unique();
            $table->string('password');
            $table->string('level');
            $table->enum('ck_level', ['ck_toolbar', 'ck_toolbarPro'])->default('ck_toolbar');
            $table->string('ck_finder_access', 30)->default("1,1,1,1,1,1,1,1,1,1,1");
            $table->string('lang')->default('ru');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('ip',255)->nullable();
            $table->string('device_id',255)->nullable();
            $table->string('dev_token',255)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('accounts')->insert([
            [
                'login' => 'developer',
                'password' => Hash::make(uniqid()),
                'level' => 'developer'
            ]
        ]);

        Schema::create('languages', function($table){
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('code', 2)->unique();
            $table->boolean('default')->default(0);
            $table->boolean('fallback')->default(0);
            $table->boolean('default_admin')->default(0);
            $table->boolean('hidden')->default(0);
            $table->boolean('hidden_admin')->default(0);
            $table->string('name', 25)->nullable();
            $table->integer('order')->default(0);
        });
        DB::table('languages')->insert(
            [
                'code' => 'ru',
                'default' => 1,
                'default_admin' => 1,
                'name' => 'Русский'
            ]
        );
        DB::table('languages')->insert(
            [
                'code' => 'uk',
                'name' => 'Українська',
                'fallback' => 1,
                'order' => 1,
                'hidden' => 1,
                'hidden_admin' => 1,
            ]
        );
        DB::table('languages')->insert(
            [
                'code' => 'en',
                'name' => 'English',
                'order' => 2,
                'hidden' => 1,
                'hidden_admin' => 1,
            ]
        );

        Schema::create('params', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permitted_ip', 255)->nullable();
            $table->string('link_for_redirects', 255)->nullable();
            $table->string('timezone')->default('Europe/Kiev')->nullable();
            $table->string('aspects', 255)->nullable();
            $table->boolean('is_installed')->default(0);
            $table->boolean('is_debug')->default(1);
            $table->boolean('is_block')->default(1);
            $table->boolean('is_logs')->default(1);
            $table->boolean('is_nocopy')->default(0);
            $table->boolean('is_cabinet')->default(1);
            $table->boolean('is_sphinx')->default(0);
            $table->boolean('is_redis')->default(0);
            $table->boolean('is_cookie')->default(0);
            $table->string('default_auth_bg', 255)->nullable();
        });

        DB::table('params')->insert(
            [
                'permitted_ip' => "127.0.0.1,46.201.243.237,109.87.115.3,159.224.52.101,178.165.9.88,109.87.9.151,82.207.41.14",
                'aspects' => "1:1,4:3,3:4,3:5,16:9",
            ]
        );

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->string('alias', 255)->unique();
            $table->string('lang_name', 255)->nullable();
            $table->string('route', 255)->unique();
            $table->integer('sort_order')->default(0);
            $table->text('icon')->nullable();
            $table->boolean('is_enabled')->default(1);          
        });

        Schema::table('sections', function(Blueprint $table) {
            $table->foreign('parent_id', 'sections_ibfk_1')->references('id')->on('sections')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('sections_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('section_id')->unsigned()->index();
            $table->string('access_type', 255)->default("edit");
        });

        Schema::table('sections_accounts', function(Blueprint $table) {
            $table->foreign('account_id', 'sections_accounts_ibfk_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('section_id', 'sections_accounts_ibfk_2')->references('id')->on('sections')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('brandbook_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color', 255)->nullable()->default("#000000");
            $table->string('name', 255)->nullable();
            $table->integer('sort_order')->default(0);
        });

        DB::table('brandbook_colors')->insert([
            ['color' => "#000000", 'name' => "Черный", 'sort_order' => 0],
            ['color' => "#FFFFFF", 'name' => "Белый", 'sort_order' => 1]
        ]);

        Schema::create('brandbook_themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable()->default("New theme");
            $table->integer('sort_order')->default(0);
        });

        DB::table('brandbook_themes')->insert([
            ['name' => "Default", 'sort_order' => 0],
        ]);

        Schema::create('form_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255)->unique();
            $table->text('name')->nullable();
            $table->text('sender')->nullable();
            $table->string('back_email', 255)->nullable();
        });

        DB::table('form_types')->insert([
            ['alias' => "feedback", 'name' => "Обратная связь"],
            ['alias' => "callback", 'name' => "Запрос обр. звонка"],
        ]);

        Schema::create('form_types_accounts', function (Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('account_id')->index()->unsigned();
            $table->integer('form_type_id')->index()->unsigned();
        });

        Schema::table('form_types_accounts', function(Blueprint $table) {
            $table->foreign('account_id', 'form_types_accounts_account_id')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('form_type_id', 'form_types_accounts_form_type_id')->references('id')->on('form_types')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });

        Schema::create('seo', function (Blueprint $table) {
            $table->increments('id');
            $table->text('yandex_verification')->nullable();
            $table->text('google_verification')->nullable();
            $table->text('google_analytics')->nullable();
            $table->text('yandex_metrika')->nullable();
            $table->text('facebook_pixel')->nullable();
            $table->text('jivosite')->nullable();
            $table->text('yandex_verification_home')->nullable();
            $table->text('google_verification_home')->nullable();
            $table->text('google_analytics_home')->nullable();
            $table->text('yandex_metrika_home')->nullable();
            $table->text('facebook_pixel_home')->nullable();
            $table->text('jivosite_home')->nullable();
            $table->string('logo_img_1', 255)->nullable();
            $table->string('logo_img_2', 255)->nullable();
            $table->string('logo_img_3', 255)->nullable();
            $table->string('logo_img_4', 255)->nullable();
            $table->text('logo_svg_1')->nullable();
            $table->text('logo_svg_2')->nullable();
            $table->text('logo_svg_3')->nullable();
            $table->text('logo_svg_4')->nullable();
            $table->boolean('noindex')->default(1);            
        });

        DB::table('seo')->insert([
            'id' => 1
        ]);

        Schema::create('redirects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('old_url', 255)->nullable();
            $table->string('new_url', 255)->nullable();
            $table->string('code', 255)->nullable();
            $table->string('note', 255)->nullable();
            $table->boolean('is_use')->default(1);
        });

        DB::table('sections')->insert([
            [
                'alias' => 'cabinet',
                'lang_name' => 'AdminPanel::main.sections.cabinet',
                'route' => 'admin.cabinet.index',
            ],
            [
                'alias' => 'edit_accounts',
                'lang_name' => 'AdminPanel::main.sections.edit_accounts',
                'route' => 'admin.edit_accounts.index',
            ],
            [
                'alias' => 'brandbook',
                'lang_name' => 'AdminPanel::main.sections.brandbook',
                'route' => 'admin.brandbook.index',
            ],
            [
                'alias' => 'cms_params',
                'lang_name' => 'AdminPanel::main.sections.cms_params',
                'route' => 'admin.params.index',
            ],
            [
                'alias' => 'seo',
                'lang_name' => 'AdminPanel::main.sections.seo',
                'route' => 'admin.seo.index',
            ],
        ]);
        $parent_id = DB::table('sections')->where('alias', 'cms_params')->first()->id;
        DB::table('sections')->insert([
            [
                'alias' => 'auth_bg',
                'lang_name' => 'AdminPanel::main.sections.auth_bg',
                'route' => 'admin.params.authBg',
                'parent_id' => $parent_id
            ],
            [
                'alias' => 'sections',
                'lang_name' => 'AdminPanel::main.sections.sections',
                'route' => 'admin.params.sections',
                'parent_id' => $parent_id
            ],
            [
                'alias' => 'email_params',
                'lang_name' => 'AdminPanel::main.sections.email_params',
                'route' => 'admin.params.emailParams',
                'parent_id' => $parent_id
            ],
            [
                'alias' => 'lang_params',
                'lang_name' => 'AdminPanel::main.sections.lang_params',
                'route' => 'admin.params.langParams',
                'parent_id' => $parent_id
            ],
            [
                'alias' => 'ip_block',
                'lang_name' => 'AdminPanel::main.sections.ip_block',
                'route' => 'admin.params.ipBlock',
                'parent_id' => $parent_id
            ],
            [
                'alias' => 'another_params',
                'lang_name' => 'AdminPanel::main.sections.another_params',
                'route' => 'admin.params.anotherParams',
                'parent_id' => $parent_id
            ],
            [
                'alias' => 'redirects',
                'lang_name' => 'AdminPanel::main.sections.redirects',
                'route' => 'admin.params.redirects',
                'parent_id' => $parent_id
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('redirects');
        Schema::dropIfExists('seo');
        Schema::dropIfExists('form_types_accounts');
        Schema::dropIfExists('form_types');
        Schema::dropIfExists('brandbook_colors');
        Schema::dropIfExists('brandbook_themes');
        Schema::dropIfExists('sections_accounts');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('params');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('accounts');
    }
}
