<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Integrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent_id = DB::table('sections')->where('alias', 'cms_params')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'integrations',
                'lang_name' => 'AdminPanel::main.sections.integrations',
                'route' => 'admin.integrations',
            ],
        ]);

        $parent_id = DB::table('sections')->where('alias', 'integrations')->first()->id;

        DB::table('sections')->insert([
            [
                'alias'      => 'jivosite',
                'lang_name'  => 'AdminPanel::main.sections.jivosite',
                'route'      => 'admin.jivosite',
                'parent_id'  => $parent_id,
                'is_in_menu' => 0,
            ],
            [
                'alias'      => 'new_post',
                'lang_name'  => 'AdminPanel::main.sections.new_post',
                'route'      => 'admin.new_post',
                'parent_id'  => $parent_id,
                'is_in_menu' => 0,
            ],
            [
                'alias'      => 'liqpay',
                'lang_name'  => 'AdminPanel::main.sections.liqpay',
                'route'      => 'admin.liqpay',
                'parent_id'  => $parent_id,
                'is_in_menu' => 0,
            ],
        ]);

        Schema::create('integrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255)->nullable();
            $table->text('code', 255)->nullable();
            $table->text('key', 255)->nullable();
            $table->text('public', 255)->nullable();
            $table->string('secret', 255)->nullable();
            $table->string('currency', 255)->default('UAH');
            $table->string('description', 255)->nullable();
            $table->string('pay_type', 255)->default('buy');
            $table->boolean('sandbox')->default(1);
            $table->string('home', 255)->nullable();
        });

        $seo_params = DB::table('seo')->first();
        if ($seo_params) {
            DB::table('integrations')->insert([
                [
                    'alias' => 'jivosite',
                    'code' => $seo_params->jivosite,
                    'home' => $seo_params->jivosite_home,
                ],
            ]);
        } else {
            DB::table('integrations')->insert([
                [
                    'alias' => 'jivosite',
                ],
            ]);
        }

        DB::table('integrations')->insert([
            [
                'alias' => 'new_post',
            ],
            [
                'alias' => 'liqpay',
            ],
        ]);

        Schema::table('seo', function (Blueprint $table) {
            $table->dropColumn('jivosite');
            $table->dropColumn('jivosite_home');
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'integrations')->delete();

        Schema::table('seo', function (Blueprint $table) {
            $table->text('jivosite', 255)->nullable();
            $table->text('jivosite_home', 255)->nullable();
        });


        $jivosite = DB::table('integrations')->where('alias', 'jivosite')->first();
        if ($jivosite) {
            DB::table('seo')->update(['jivosite' => $jivosite->code, 'jivosite_home' => $jivosite->home]);
        }
        Schema::dropIfExists('integrations');
    }
}