<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketVendorFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('market_vendors', function(Blueprint $table) {
		    $table->boolean("is_code")->default(0);
		    $table->boolean("is_article")->default(0);
		    $table->boolean("is_description")->default(1);
		    $table->boolean("is_chars")->default(1);
		    $table->boolean("is_pictures")->default(1);
		    $table->boolean("is_brand")->default(1);
		});

		$vendors = \Demos\Market\Vendor::get();
		foreach ($vendors as $vendor) {
			if ($vendor->is_code_check == 1) {
				$vendor->is_code = 1;
				$vendor->is_article = 0;
			}
			if ($vendor->is_article_check == 1) {
				$vendor->is_article = 1;
				$vendor->is_code = 0;
			}
			$vendor->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('market_vendors', function(Blueprint $table) {
		    $table->dropColumn("is_code");
		    $table->dropColumn("is_article");
		    $table->dropColumn("is_description");
		    $table->dropColumn("is_chars");
		    $table->dropColumn("is_pictures");
		    $table->dropColumn("is_brand");
		});
	}

}
