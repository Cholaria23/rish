<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntegrationsMarket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('integrations', function (Blueprint $table) {
            $table->string('payments_count')->nullable();
        });
        Schema::table('market_goods', function (Blueprint $table) {
            $table->string('payments_count')->nullable();
        });
        Schema::table('market_orders', function (Blueprint $table) {
            $table->string('hash')->nullable();
        });

        \DB::table('market_orders_payment_statuses')->insert([
            [
                'is_undeletable' => 1,
                'alias' => 'error_credit',
                'name' => '{"ru":"\u041a\u0440\u0435\u0434\u0438\u0442 \u043e\u0442\u043a\u043b\u043e\u043d\u0435\u043d","uk":"\u041a\u0440\u0435\u0434\u0438\u0442 \u0432\u0456\u0434\u0445\u0438\u043b\u0435\u043d\u043e"}',
                'is_used' => 1
            ],
            [
                'is_undeletable' => 1,
                'alias' => 'refunds',
                'name' => '{"ru":"\u0412\u043e\u0437\u0432\u0440\u0430\u0442 \u0441\u0440\u0435\u0434\u0441\u0442\u0432","uk":"\u041f\u043e\u0432\u0435\u0440\u043d\u0435\u043d\u043d\u044f \u043a\u043e\u0448\u0442\u0456\u0432"}',
                'is_used' => 1
            ]
        ]);

        \DB::table('market_orders_payment_statuses')->where('alias', 'success_credit')->update(['name' => '{"ru":"\u041a\u0440\u0435\u0434\u0438\u0442 \u043e\u0434\u043e\u0431\u0440\u0435\u043d","uk":"\u041a\u0440\u0435\u0434\u0438\u0442 \u0441\u0445\u0432\u0430\u043b\u0435\u043d\u043e"}']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('integrations', function (Blueprint $table) {
            $table->dropColumn('payments_count');
        });
        Schema::table('market_goods', function (Blueprint $table) {
            $table->dropColumn('payments_count');
        });
        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropColumn('hash');
        });

        \DB::table('market_orders_payment_statuses')->where('alias', 'error_credit')->delete();
        \DB::table('market_orders_payment_statuses')->where('alias', 'refunds')->delete();
    }
}