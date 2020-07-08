<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Credit extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders_payments', function(Blueprint $table) {
            $table->boolean('is_credit')->default(0);
        });

        $sort_order = DB::table('market_orders_payments')->max('sort_order');
        DB::table('market_orders_payments')->insert([
            ['sort_order' => $sort_order + 1, 'is_undeletable' => 1, 'is_credit' => 1, 'alias' => 'ins_privat', 'name' => '{"ru":"\u041c\u0433\u043d\u043e\u0432\u0435\u043d\u043d\u0430\u044f \u0440\u0430\u0441\u0441\u0440\u043e\u0447\u043a\u0430. \u041f\u0440\u0438\u0432\u0430\u0442\u0431\u0430\u043d\u043a","uk":"\u041c\u0438\u0442\u0442\u0454\u0432\u0430 \u0440\u043e\u0437\u0441\u0442\u0440\u043e\u0447\u043a\u0430. \u041f\u0440\u0438\u0432\u0430\u0442\u0431\u0430\u043d\u043a"}'],
            ['sort_order' => $sort_order + 2, 'is_undeletable' => 1, 'is_credit' => 1, 'alias' => 'parts_privat', 'name' => '{"ru":"\u041e\u043f\u043b\u0430\u0442\u0430 \u0447\u0430\u0441\u0442\u044f\u043c\u0438. \u041f\u0440\u0438\u0432\u0430\u0442\u0431\u0430\u043d\u043a","uk":"\u041e\u043f\u043b\u0430\u0442\u0430 \u0447\u0430\u0441\u0442\u0438\u043d\u0430\u043c\u0438. \u041f\u0440\u0438\u0432\u0430\u0442\u0431\u0430\u043d\u043a"}'],
            ['sort_order' => $sort_order + 3, 'is_undeletable' => 1, 'is_credit' => 1, 'alias' => 'ins_mono', 'name' => '{"ru":"\u041c\u0433\u043d\u043e\u0432\u0435\u043d\u043d\u0430\u044f \u0440\u0430\u0441\u0441\u0440\u043e\u0447\u043a\u0430. \u041c\u043e\u043d\u043e\u0431\u0430\u043d\u043a","uk":"\u041c\u0438\u0442\u0442\u0454\u0432\u0430 \u0440\u043e\u0437\u0441\u0442\u0440\u043e\u0447\u043a\u0430. \u041c\u043e\u043d\u043e\u0431\u0430\u043d\u043a"}'],
            ['sort_order' => $sort_order + 4, 'is_undeletable' => 1, 'is_credit' => 1, 'alias' => 'parts_mono', 'name' => '{"ru":"\u041e\u043f\u043b\u0430\u0442\u0430 \u0447\u0430\u0441\u0442\u044f\u043c\u0438. \u041c\u043e\u043d\u043e\u0431\u0430\u043d\u043a","uk":"\u041e\u043f\u043b\u0430\u0442\u0430 \u0447\u0430\u0441\u0442\u0438\u043d\u0430\u043c\u0438. \u041c\u043e\u043d\u043e\u0431\u0430\u043d\u043a"}'],
        ]);

        $deliveries = DB::table('market_orders_deliveries')->get()->pluck('id')->toArray();
        $payment_id = DB::table('market_orders_payments')->where('alias', 'ins_privat')->first()->id;
        foreach ($deliveries as $delivery) {
            DB::table('market_orders_deliveries_payments')->insert(['delivery_id' => $delivery, 'payment_id' => $payment_id]);
        }
        $payment_id = DB::table('market_orders_payments')->where('alias', 'parts_privat')->first()->id;
        foreach ($deliveries as $delivery) {
            DB::table('market_orders_deliveries_payments')->insert(['delivery_id' => $delivery, 'payment_id' => $payment_id]);
        }
        $payment_id = DB::table('market_orders_payments')->where('alias', 'ins_mono')->first()->id;
        foreach ($deliveries as $delivery) {
            DB::table('market_orders_deliveries_payments')->insert(['delivery_id' => $delivery, 'payment_id' => $payment_id]);
        }
        $payment_id = DB::table('market_orders_payments')->where('alias', 'parts_mono')->first()->id;
        foreach ($deliveries as $delivery) {
            DB::table('market_orders_deliveries_payments')->insert(['delivery_id' => $delivery, 'payment_id' => $payment_id]);
        }
        Schema::table('market_orders', function(Blueprint $table) {
            $table->double('monthly_payment')->nullable();
            $table->integer('payments_count')->nullable();
        });

        Schema::create('market_goods_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
            $table->integer('payment_id')->unsigned()->index();
            $table->integer('min_payments_count')->default(1);
            $table->integer('max_payments_count')->default(1);
        });

        Schema::table('market_goods_payments', function(Blueprint $table) {
            $table->foreign('good_id', 'market_goods_payments_1')->references('id')->on('market_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('payment_id', 'market_goods_payments_2')->references('id')->on('market_orders_payments')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders_payments', function(Blueprint $table) {
            $table->dropColumn('is_credit');
        });
        DB::table('market_orders_payments')->where('alias', 'ins_privat')->delete();
        DB::table('market_orders_payments')->where('alias', 'parts_privat')->delete();
        DB::table('market_orders_payments')->where('alias', 'ins_mono')->delete();
        DB::table('market_orders_payments')->where('alias', 'parts_mono')->delete();

        Schema::table('market_orders', function(Blueprint $table) {
            $table->dropColumn('monthly_payment');
            $table->dropColumn('payments_count');
        });

        Schema::table('market_goods_payments', function (Blueprint $table) {
            $table->dropForeign('market_goods_payments_1');
            $table->dropForeign('market_goods_payments_2');
        });

        Schema::drop('market_goods_payments');
    }
}






