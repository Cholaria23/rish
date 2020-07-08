<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('sections')->insert([
            [
                'alias' => 'contacts',
                'lang_name' => 'AdminPanel::main.sections.contacts',
                'route' => 'admin.contacts.index',
            ]
        ]);

        Schema::create('contacts_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_hidden')->default(1); 
            $table->string('alias', 255)->nullable();
        });

        Schema::create('contacts_groups_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
        });

        Schema::table('contacts_groups_lang', function(Blueprint $table) {
            $table->foreign('group_id', 'contacts_groups_lang_1')->references('id')->on('contacts_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });


        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->string('phone_1', 255)->nullable();
            $table->string('phone_2', 255)->nullable();
            $table->string('phone_3', 255)->nullable();
            $table->string('phone_4', 255)->nullable();
            $table->string('phone_5', 255)->nullable();
            $table->string('email_1', 255)->nullable();
            $table->string('email_2', 255)->nullable();
            $table->string('viber', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();
            $table->string('skype', 255)->nullable();
            $table->string('telegram', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('vk', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->string('site_1', 255)->nullable();
            $table->string('site_2', 255)->nullable();
            $table->text('map_link')->nullable();
            $table->text('map_iframe')->nullable();
            $table->text('pano_iframe')->nullable();
        });

        Schema::table('contacts', function(Blueprint $table) {
            $table->foreign('group_id', 'contacts_1')->references('id')->on('contacts_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('contacts_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('phone_1_name', 255)->nullable();
            $table->string('phone_2_name', 255)->nullable();
            $table->string('phone_3_name', 255)->nullable();
            $table->string('phone_4_name', 255)->nullable();
            $table->string('phone_5_name', 255)->nullable();
            $table->string('phone_1_info', 255)->nullable();
            $table->string('phone_2_info', 255)->nullable();
            $table->string('phone_3_info', 255)->nullable();
            $table->string('phone_4_info', 255)->nullable();
            $table->string('phone_5_info', 255)->nullable();
            $table->string('email_1_name', 255)->nullable();
            $table->string('email_2_name', 255)->nullable();
            $table->string('email_1_info', 255)->nullable();
            $table->string('email_2_info', 255)->nullable();
            $table->string('site_1_name', 255)->nullable();
            $table->string('site_2_name', 255)->nullable();
            $table->string('site_1_info', 255)->nullable();
            $table->string('site_2_info', 255)->nullable();
            $table->text('address')->nullable();
            $table->text('note_1')->nullable();
            $table->text('note_2')->nullable();
            $table->text('org_name_short')->nullable();
            $table->text('org_name_full')->nullable();
        });

        Schema::table('contacts_lang', function(Blueprint $table) {
            $table->foreign('contact_id', 'contacts_lang_1')->references('id')->on('contacts')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('contacts_groups')->insert(
            [
                'is_hidden' => 0,
                'alias' => 'main',
            ]
        );

        DB::table('contacts_groups_lang')->insert([
            [
                'group_id' => 1,
                'lang' => 'ru',
                'name' => 'Основные контакты',
            ],
            [
                'group_id' => 1,
                'lang' => 'uk',
                'name' => 'Основні контакти',
            ],
            [
                'group_id' => 1,
                'lang' => 'en',
                'name' => 'Main',
            ]
        ]);

        DB::table('contacts')->insert([
            [
                'group_id' => 1,
            ]
        ]);

        DB::table('contacts_lang')->insert([
            [
                'contact_id' => 1,
                'lang' => 'ru',
            ],
            [
                'contact_id' => 1,
                'lang' => 'uk',
            ],
            [
                'contact_id' => 1,
                'lang' => 'en',
            ],
        ]);

        Schema::create('contacts_icons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_svg', 255)->nullable();
            $table->string('phone_img', 255)->nullable();
            $table->string('viber_svg', 255)->nullable();
            $table->string('viber_img', 255)->nullable();
            $table->string('whatsapp_svg', 255)->nullable();
            $table->string('whatsapp_img', 255)->nullable();
            $table->string('email_svg', 255)->nullable();
            $table->string('email_img', 255)->nullable();
            $table->string('facebook_svg', 255)->nullable();
            $table->string('facebook_img', 255)->nullable();
            $table->string('instagram_svg', 255)->nullable();
            $table->string('instagram_img', 255)->nullable();
            $table->string('google_plus_svg', 255)->nullable();
            $table->string('google_plus_img', 255)->nullable();
            $table->string('twitter_svg', 255)->nullable();
            $table->string('twitter_img', 255)->nullable();
            $table->string('linkedin_svg', 255)->nullable();
            $table->string('linkedin_img', 255)->nullable();
            $table->string('skype_svg', 255)->nullable();
            $table->string('skype_img', 255)->nullable();
            $table->string('telegram_svg', 255)->nullable();
            $table->string('telegram_img', 255)->nullable();
            $table->string('map_link_svg', 255)->nullable();
            $table->string('map_link_img', 255)->nullable();
            $table->string('map_iframe_svg', 255)->nullable();
            $table->string('map_iframe_img', 255)->nullable();
            $table->string('pano_iframe_svg', 255)->nullable();
            $table->string('pano_iframe_img', 255)->nullable();
            $table->string('site_svg', 255)->nullable();
            $table->string('site_img', 255)->nullable();
            $table->string('youtube_svg', 255)->nullable();
            $table->string('youtube_img', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'contacts')->delete();
        Schema::dropIfExists('contacts_icons');
        Schema::dropIfExists('contacts_lang');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('contacts_groups_lang');
        Schema::dropIfExists('contacts_groups');
    }
}
