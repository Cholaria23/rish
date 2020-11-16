<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('market_goods_rel_types', function(Blueprint $table) {
            DB::statement("ALTER TABLE `market_goods_rel_types` CHANGE `name` `name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; ");
        });

        DB::table('market_goods_rel_types')->where('name', 'direct')->update(['name' => '{"uk":"\u0417 \u0446\u0438\u043c \u0442\u043e\u0432\u0430\u0440\u043e\u043c \u043a\u0443\u043f\u0443\u044e\u0442\u044c","ru":"\u0421 \u044d\u0442\u0438\u043c \u0442\u043e\u0432\u0430\u0440\u043e\u043c \u043f\u043e\u043a\u0443\u043f\u0430\u044e\u0442"}']);

        DB::table('market_goods_rel_types')->insert([
            ['is_undeletable' => 1, 'name' => '{"uk":"\u0421\u0445\u043e\u0436\u0456 \u0442\u043e\u0432\u0430\u0440\u0438","ru":"\u041f\u043e\u0445\u043e\u0436\u0438\u0435 \u0442\u043e\u0432\u0430\u0440\u044b"}'],
            ['is_undeletable' => 1, 'name' => '{"ru":"\u0421\u0432\u044f\u0437\u0430\u043d\u043d\u0430\u044f \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u044f","uk":"\u041f\u043e\u0432\'\u044f\u0437\u0430\u043d\u0430 \u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0456\u044f"}'],
            ['is_undeletable' => 1, 'name' => '{"uk":"\u0414\u043e\u0441\u0442\u0443\u043f\u043d\u0456 \u043a\u043e\u043b\u044c\u043e\u0440\u0438","ru":"\u0414\u043e\u0441\u0442\u0443\u043f\u043d\u044b\u0435 \u0446\u0432\u0435\u0442\u0430"}'],
        ]);


        Schema::table('market_goods', function(Blueprint $table) {
            $table->integer('length')->default(0);
            $table->integer('width')->default(0);
            $table->integer('height')->default(0);
            $table->integer('weight')->default(0);
            $table->integer('volume')->default(0);
            $table->string('linear_units', 255)->default('m');
            $table->string('weight_units', 255)->default('kg');
            $table->string('volume_units', 255)->default('l');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_goods_rel_types', function(Blueprint $table) {
            DB::statement("ALTER TABLE `market_goods_rel_types` CHANGE `name` `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;");
        });

        Schema::table('market_goods', function(Blueprint $table) {
            $table->dropColumn('length');
            $table->dropColumn('width');
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('volume');
            $table->dropColumn('linear_units');
            $table->dropColumn('weight_units');
            $table->dropColumn('volume_units');
        });
    }
}