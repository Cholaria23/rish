<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketOrderTransId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('market_orders', function(Blueprint $table) {
		    $table->string("trans_id")->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('market_orders', function(Blueprint $table) {
		    $table->dropColumn("trans_id");
		});
	}

}
