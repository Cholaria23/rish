<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketVendors extends Migration
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
                'alias' => 'market_vendors_sync',
                'lang_name' => 'Market::main.sections.vendors_sync',
                'route' => 'admin.market.vendorsSync',
                'parent_id' => $parent_id
            ],
        ]);

        Schema::create('market_vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
            $table->text("yml_href")->nullable();
            $table->boolean("last")->default(0);
            $table->text("cats")->nullable();
            $table->boolean("is_article_check")->default(0);
            $table->boolean("is_code_check")->default(0);

            $table->integer("main_price_type_id")->nullable()->unsigned();
            $table->foreign("main_price_type_id")
                  ->references("id")->on('market_price_types')
                  ->onDelete("cascade");

            $table->integer("action_price_type_id")->nullable()->unsigned();
            $table->foreign("action_price_type_id")
                  ->references("id")->on('market_price_types')
                  ->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('market_vendors_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string("vendor_good_id");
            $table->integer("vendor_id")->unsigned();
            $table->foreign("vendor_id")
                  ->references("id")->on('market_vendors')
                  ->onDelete("cascade");
            $table->integer("good_id")->unsigned();
            $table->foreign("good_id")
                  ->references("id")->on('market_goods')
                  ->onDelete("cascade");
        });

        Schema::table('market_goods', function (Blueprint $table) {
            $table->boolean('is_price_yml_update')->default(1);
            $table->boolean('is_remains_yml_update')->default(1);
            $table->dateTime('vendor_updated_at')->nullable();
        });

        Schema::create('market_vendors_tmp_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string("category_id");
            $table->integer("vendor_id")->unsigned();
            $table->foreign("vendor_id")
                  ->references("id")->on('market_vendors')
                  ->onDelete("cascade");
            $table->string("vendor_good_id");
            $table->float("price")->nullable();
            $table->float("action_price")->nullable();
            $table->float("rate")->default(1);
            $table->string("currency_id")->nullable();
            $table->string("url")->nullable();
            $table->string("name")->nullable();
            $table->string("vendor")->nullable();
            $table->string("vendor_code")->nullable();
            $table->string("country_of_origin")->nullable();
            $table->text("description")->nullable();
            $table->text("chars")->nullable();
            $table->text("pictures")->nullable();
            $table->integer("available")->default(0);
            $table->boolean("pickup")->default(1);
            $table->boolean("delivery")->default(1);
        });

        Schema::create('market_vendors_tmp_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("vendor_id")->unsigned();
            $table->foreign("vendor_id")
                  ->references("id")->on('market_vendors')
                  ->onDelete("cascade");
            $table->string("vendor_good_id");
            $table->boolean("is_cover")->default(0);
            $table->integer("good_id")->unsigned();
            $table->foreign("good_id")
                  ->references("id")->on('market_goods')
                  ->onDelete("cascade");
            $table->string("src")->nullable();
            $table->string("status")->default('new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop("market_vendors_tmp_goods");
        Schema::drop("market_vendors_tmp_pictures");
        Schema::drop("market_vendors_goods");
        Schema::drop("market_vendors");
        Schema::table('market_goods', function(Blueprint $table) {
            $table->dropColumn("is_price_yml_update");
            $table->dropColumn("is_remains_yml_update");
            $table->dropColumn("vendor_updated_at");
        });
        DB::table('sections')->where('alias', 'market_vendors_sync')->delete(); 
    }
}