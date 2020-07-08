<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $parent_id = DB::table('sections')->where('alias', 'cms_params')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'dashboard_params',
                'lang_name' => 'AdminPanel::main.sections.dashboard_params',
                'route' => 'admin.dashboard.index',
                'parent_id' => $parent_id
            ],
        ]);

        Schema::create('widgets', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->boolean('is_hidden')->default(0);
            $table->boolean('is_default')->default(1);
            $table->integer('order_id')->default(0);
            $table->string('section')->nullable();
            $table->string('color')->nullable();
            $table->integer('width')->nullable();
        });

        Schema::create('widgets_accounts', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('widget_id');
            $table->unsignedInteger('account_id');
            $table->integer('order_id')->default(0);
        });

        Schema::table('widgets_accounts', function (Blueprint $table) {
            $table->foreign('widget_id', 'widgets_accounts_ibfk_1')->references('id')->on('widgets')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('account_id', 'widgets_accounts_ibfk_2')->references('id')->on('accounts')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        DB::table('widgets')->insert([
            [
                'name' => 'links',
                'section' => NULL,
                'order_id' => 0,
                'color' => NULL,
                'width' => '100',
            ],[
                'name' => 'units',
                'section' => 'units',
                'order_id' => 1,
                'color' => 'orange',
                'width' => '25',
            ],[
                'name' => 'leads',
                'section' => 'leads',
                'order_id' => 3,
                'color' => 'blue',
                'width' => '25',
            ],[
                'name' => 'favorite_categories',
                'section' => 'units',
                'order_id' => 8,
                'color' => NULL,
                'width' => '100',
            ],[
                'name' => 'last_modified_units',
                'section' => 'units',
                'order_id' => 9,
                'color' => NULL,
                'width' => '100',
            ],[
                'name' => 'most_viewed_units',
                'section' => 'units',
                'order_id' => 10,
                'color' => NULL,
                'width' => '100',
            ]
        ]);

        if(class_exists(\Demos\Market\MarketServiceProvider::class)){
            DB::table('widgets')->insert([
                [
                    'name' => 'market',
                    'section' => 'market',
                    'order_id' => 2,
                    'color' => 'pink',
                    'width' => '25',
                ],[
                    'name' => 'last_3_orders',
                    'section' => 'market_orders_statistic',
                    'order_id' => 4,
                    'color' => 'orange',
                    'width' => '25',
                ],[
                    'name' => 'market_orders',
                    'section' => 'market_orders',
                    'order_id' => 5,
                    'color' => 'green',
                    'width' => '25',
                ],[
                    'name' => 'last_year_orders',
                    'section' => 'market_orders_statistic',
                    'order_id' => 7,
                    'color' => NULL,
                    'width' => '33',
                ],[
                    'name' => 'favorite_market_categories',
                    'section' => 'market',
                    'order_id' => 11,
                    'color' => NULL,
                    'width' => '100',
                ],[
                    'name' => 'last_modified_goods',
                    'section' => 'goods',
                    'order_id' => 12,
                    'color' => NULL,
                    'width' => '100',
                ],[
                    'name' => 'most_viewed_goods',
                    'section' => 'goods',
                    'order_id' => 13,
                    'color' => NULL,
                    'width' => '100',
                ],
            ]);
        }

        $widgets = DB::table('widgets')->get();
        $insert = [];
        $accounts = DB::table('accounts')->where('is_banned', 0)->get();
        foreach ($accounts as $account) {
            foreach ($widgets as $widget) {
                $insert[] = [
                    'widget_id' => $widget->id,
                    'account_id' => $account->id,
                    'order_id' => $widget->order_id
                ];
            }
        }
        DB::table('widgets_accounts')->insert($insert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('widgets_accounts', function (Blueprint $table) {
            $table->dropForeign('widgets_accounts_ibfk_1');
            $table->dropForeign('widgets_accounts_ibfk_2');
        });

        Schema::dropIfExists('widgets');

        Schema::dropIfExists('widgets_accounts');

        DB::table('sections')->where('alias', 'dashboard_params')->delete();
    }
}
