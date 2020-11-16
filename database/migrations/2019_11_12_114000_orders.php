<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $parent_id = DB::table('sections')->where('alias', 'market')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'market_orders',
                'lang_name' => 'Market::main.sections.orders',
                'route' => 'admin.market.orders',
                'parent_id' => $parent_id
            ],
        ]);

        Schema::create('market_orders_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_undeletable')->default(0);
            $table->boolean('is_used')->default(0);
            $table->text('name')->nullable();
        });

        DB::table('market_orders_statuses')->insert([
            ['is_undeletable' => 1, 'name' => '{"ru":"\u041d\u043e\u0432\u044b\u0439","uk":""}'],
            ['is_undeletable' => 1, 'name' => '{"ru":"\u0412 \u0440\u0430\u0431\u043e\u0442\u0435","uk":""}'],
            ['is_undeletable' => 1, 'name' => '{"ru":"\u0412\u044b\u043f\u043e\u043b\u043d\u0435\u043d\u043d\u044b\u0439","uk":""}'],
            ['is_undeletable' => 1, 'name' => '{"ru":"\u041e\u0442\u043c\u0435\u043d\u0435\u043d\u043d\u044b\u0439","uk":""}'],
        ]);

        Schema::create('market_orders_deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_undeletable')->default(0);
            $table->boolean('is_used')->default(0);
            $table->text('name')->nullable();
        });

        Schema::create('market_orders_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_undeletable')->default(0);
            $table->boolean('is_used')->default(0);
            $table->text('name')->nullable();
        });

        Schema::create('market_orders', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->nullable()->index()->unsigned();
            $table->integer('delivery_id')->nullable()->index()->unsigned();
            $table->integer('payment_id')->nullable()->index()->unsigned();
            $table->integer('user_id')->nullable()->index()->unsigned();
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('fathername_name', 255)->nullable();            
            $table->text('note')->nullable();
            $table->foreign('status_id', 'market_orders_1')->references('id')->on('market_orders_statuses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('delivery_id', 'market_orders_2')->references('id')->on('market_orders_deliveries')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('payment_id', 'market_orders_3')->references('id')->on('market_orders_payments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'market_orders_4')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('market_orders_goods', function(Blueprint $table) {
            $table->integer('good_id')->nullable()->index()->unsigned();
            $table->integer('order_id')->nullable()->index()->unsigned();
            $table->integer('curr_id')->nullable()->index()->unsigned();
            $table->float('price')->nullable();
            $table->integer('count')->nullable();
            $table->foreign('good_id', 'market_orders_goods_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('order_id', 'market_orders_goods_2')->references('id')->on('market_orders')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('curr_id', 'market_orders_goods_3')->references('id')->on('market_currs')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('form_types')->insert([
            ['alias' => "market_order", 'name' => '{"ru":"\u0417\u0430\u043a\u0430\u0437 \u0432 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u0435","uk":"\u0417\u0430\u043c\u043e\u0432\u043b\u0435\u043d\u043d\u044f \u0432 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u0456"}'],
            ['alias' => "good_request", 'name' => '{"ru":"\u0417\u0430\u043f\u0440\u043e\u0441 \u043d\u0430\u043b\u0438\u0447\u0438\u044f \u0442\u043e\u0432\u0430\u0440\u0430","uk":"\u0417\u0430\u043f\u0438\u0442 \u043d\u0430\u044f\u0432\u043d\u043e\u0441\u0442\u0456 \u0442\u043e\u0432\u0430\u0440\u0443"}'],
            ['alias' => "price_request", 'name' => '{"ru":"\u0417\u0430\u043f\u0440\u043e\u0441 \u0446\u0435\u043d\u044b","uk":"\u0417\u0430\u043f\u0438\u0442 \u0446\u0456\u043d\u0438"}'],
            ['alias' => "notify_arrival", 'name' => '{"ru":"\u0423\u0432\u0435\u0434\u043e\u043c\u0438\u0442\u044c \u043e \u043f\u043e\u0441\u0442\u0443\u043f\u043b\u0435\u043d\u0438\u0438","uk":"\u041f\u043e\u0432\u0456\u0434\u043e\u043c\u0438\u0442\u0438 \u043f\u0440\u043e \u043d\u0430\u0434\u0445\u043e\u0434\u0436\u0435\u043d\u043d\u044f"}'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'market_orders')->delete();   
        DB::table('form_types')->where('alias', 'market_order')->delete();   
        Schema::table('market_orders_goods', function (Blueprint $table) {
            $table->dropForeign('market_orders_goods_1');
            $table->dropForeign('market_orders_goods_2');
            $table->dropForeign('market_orders_goods_3');
        });
        Schema::dropIfExists('market_orders_goods');       

        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropForeign('market_orders_1');
            $table->dropForeign('market_orders_2');
            $table->dropForeign('market_orders_3');
            $table->dropForeign('market_orders_4');
        });

        Schema::dropIfExists('market_orders');       
        Schema::dropIfExists('market_orders_payments');       
        Schema::dropIfExists('market_orders_deliveries');       
        Schema::dropIfExists('market_orders_statuses');       
    }
}