<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketUpdateOrdersFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_orders_statuses', function(Blueprint $table) {
            $table->string('alias')->nullable();
        });
        Schema::table('market_orders_payments', function(Blueprint $table) {
            $table->string('alias')->nullable();
        });
        Schema::table('market_orders_deliveries', function(Blueprint $table) {
            $table->string('alias')->nullable();
        });

        DB::table('market_orders_statuses')->where('id', 1)->update(['alias' => 'new']);
        DB::table('market_orders_statuses')->where('id', 2)->update(['alias' => 'in_work']);
        DB::table('market_orders_statuses')->where('id', 3)->update(['alias' => 'completed']);
        DB::table('market_orders_statuses')->where('id', 4)->update(['alias' => 'canceled']);

        DB::table('market_orders_payments')->where('id', '>', '0')->delete();

        DB::table('market_orders_payments')->insert([
            ['id' => 1, 'is_undeletable' => 1, 'alias' => 'cash', 'name' => '{"ru":"\u041d\u0430\u043b\u0438\u0447\u043d\u044b\u043c\u0438 (\u043f\u0440\u0438 \u043f\u043e\u043b\u0443\u0447\u0435\u043d\u0438\u0438)","uk":"\u0413\u043e\u0442\u0456\u0432\u043a\u043e\u044e (\u043f\u0440\u0438 \u043e\u0442\u0440\u0438\u043c\u0430\u043d\u043d\u0456)"}'],
            ['id' => 2, 'is_undeletable' => 1, 'alias' => 'card', 'name' => '{"ru":"\u041e\u043f\u043b\u0430\u0442\u0430 \u043a\u0430\u0440\u0442\u043e\u0439 VIsa, MasterCard","uk":"\u041e\u043f\u043b\u0430\u0442\u0430 \u043a\u0430\u0440\u0442\u043a\u043e\u044e VIsa, MasterCard"}'],
            ['id' => 3, 'is_undeletable' => 1, 'alias' => 'bank_transfer', 'name' => '{"ru":"\u0411\u0430\u043d\u043a\u043e\u0432\u0441\u043a\u0438\u0439 \u043f\u0435\u0440\u0435\u0432\u043e\u0434 (\u0411\u0435\u0437\u043d\u0430\u043b\u0438\u0447\u043d\u044b\u0439 \u0440\u0430\u0441\u0447\u0435\u0442)","uk":"\u0411\u0430\u043d\u043a\u0456\u0432\u0441\u044c\u043a\u0438\u0439 \u043f\u0435\u0440\u0435\u043a\u0430\u0437 (\u0411\u0435\u0437\u0433\u043e\u0442\u0456\u0432\u043a\u043e\u0432\u0438\u0439 \u0440\u043e\u0437\u0440\u0430\u0445\u0443\u043d\u043e\u043a)"}'],
            ['id' => 4, 'is_undeletable' => 1, 'alias' => 'cod', 'name' => '{"ru":"\u041d\u0430\u043b\u043e\u0436\u0435\u043d\u043d\u044b\u0439 \u043f\u043b\u0430\u0442\u0435\u0436","uk":"\u041d\u0430\u043a\u043b\u0430\u0434\u0435\u043d\u0438\u0439 \u043f\u043b\u0430\u0442\u0456\u0436"}'],
            ['id' => 5, 'is_undeletable' => 1, 'alias' => 'liqpay', 'name' => '{"ru":"LiqPay","uk":"LiqPay"}'],
        ]);

        DB::table('market_orders_deliveries')->where('id', '>', '0')->delete();

        DB::table('market_orders_deliveries')->insert([
            ['id' => 1, 'is_undeletable' => 1, 'alias' => 'pickup', 'name' => '{"ru":"\u0421\u0430\u043c\u043e\u0432\u044b\u0432\u043e\u0437","uk":"\u0421\u0430\u043c\u043e\u0432\u0438\u0432\u0456\u0437"}'],
            ['id' => 2, 'is_undeletable' => 1, 'alias' => 'new_post', 'name' => '{"ru":"\u041d\u043e\u0432\u0430\u044f \u043f\u043e\u0447\u0442\u0430","uk":"\u041d\u043e\u0432\u0430 \u043f\u043e\u0448\u0442\u0430"}'],
            ['id' => 3, 'is_undeletable' => 1, 'alias' => 'new_post_courier', 'name' => '{"ru":"\u041d\u043e\u0432\u0430\u044f \u043f\u043e\u0447\u0442\u0430 ( \u043a\u0443\u0440\u044c\u0435\u0440\u043e\u043c \u043f\u043e \u0433\u043e\u0440\u043e\u0434\u0443)","uk":"\u041d\u043e\u0432\u0430 \u043f\u043e\u0448\u0442\u0430 (\u043a\u0443\u0440\'\u0454\u0440\u043e\u043c \u043f\u043e \u043c\u0456\u0441\u0442\u0443)"}'],
            ['id' => 4, 'is_undeletable' => 1, 'alias' => 'courier', 'name' => '{"ru":"\u0414\u043e\u0441\u0442\u0430\u0432\u043a\u0430 \u043a\u0443\u0440\u044c\u0435\u0440\u043e\u043c \u043f\u043e \u0433\u043e\u0440\u043e\u0434\u0443","uk":"\u0414\u043e\u0441\u0442\u0430\u0432\u043a\u0430 \u043a\u0443\u0440\'\u0454\u0440\u043e\u043c \u043f\u043e \u043c\u0456\u0441\u0442\u0443"}'],
            ['id' => 5, 'is_undeletable' => 1, 'alias' => 'delivery', 'name' => '{"ru":"\u0418\u043d\u044b\u0435 \u0441\u043b\u0443\u0436\u0431\u044b \u0434\u043e\u0441\u0442\u0430\u0432\u043a\u0438","uk":"\u0406\u043d\u0448\u0456 \u0441\u043b\u0443\u0436\u0431\u0438 \u0434\u043e\u0441\u0442\u0430\u0432\u043a\u0438"}'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders_statuses', function(Blueprint $table) {
            $table->dropColumn('alias');
        });
        Schema::table('market_orders_payments', function(Blueprint $table) {
            $table->dropColumn('alias');
        });
        Schema::table('market_orders_deliveries', function(Blueprint $table) {
            $table->dropColumn('alias');
        });   
    }
}










