<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketPaymentStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('market_orders_payment_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_undeletable')->default(0);
            $table->string('alias')->nullable();
            $table->text('name')->nullable();
            $table->boolean('is_used')->default(0);
        });

        Schema::table('market_orders', function (Blueprint $table) {
            $table->unsignedInteger('payment_status_id')->nullable();
            $table->foreign('payment_status_id', 'market_orders_payment_status_id_ibfk')->references('id')->on('market_orders_payment_statuses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('market_orders_payment_statuses')->insert([
            ['is_used' => 1,'is_undeletable' => 1, 'alias' => 'waiting', 'name' => '{"ru":"\u041e\u0436\u0438\u0434\u0430\u0435\u0442\u0441\u044f \u043e\u043f\u043b\u0430\u0442\u0430","uk":""}'],
            ['is_used' => 1,'is_undeletable' => 1, 'alias' => 'advance', 'name' => '{"ru":"\u041f\u043e\u0441\u0442\u0443\u043f\u0438\u043b \u0430\u0432\u0430\u043d\u0441","uk":""}'],
            ['is_used' => 1,'is_undeletable' => 1, 'alias' => 'success', 'name' => '{"ru":"\u0417\u0430\u043a\u0430\u0437 \u043e\u043f\u043b\u0430\u0447\u0435\u043d","uk":""}'],
            ['is_used' => 1,'is_undeletable' => 1, 'alias' => 'success_credit', 'name' => '{"ru":"\u041f\u043b\u0430\u0442\u0435\u0436 \u0443\u0441\u043f\u0435\u0448\u043d\u043e \u0441\u043e\u0432\u0435\u0440\u0448\u0435\u043d","uk":""}'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders', function (Blueprint $table) {
            $table->dropForeign('market_orders_payment_status_id_ibfk');
            $table->dropColumn('payment_status_id');
        });

        Schema::dropIfExists('market_orders_payment_statuses');
    }
}










