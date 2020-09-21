<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultStorage extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $crm = \Demos\Market\MarketCrmConnection::first();
        if(!$crm) $crm = \Demos\Market\MarketCrmConnection::create(['key' => md5(uniqid()), 'crm_url' => '']);
        $storage_id = DB::table('market_storages')->insertGetId(['crm_id' => 1, 'crm_connection_id' => $crm->id, 'name' => 'Склад 1']);
        $goods = \Demos\Market\Good::select(['id', 'remains'])->pluck('remains', 'id')->toArray();

        $placements_insert = [];
        foreach($goods as $id => $remains){
            $placements_insert[] = [
                'good_id' => $id,
                'storage_id' => $storage_id,
                'amount' => $remains
            ];
        }

        \Demos\Market\MarketPlacement::insert($placements_insert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('market_storages')->where('crm_id', 1)->delete();
    }
}
