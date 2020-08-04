<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderDefaultStatus extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $new_status = DB::table('market_orders_statuses')->where('alias', 'new')->first();
        if ($new_status) {
            DB::table('market_orders')->whereNull('status_id')->orWhere('status_id', '')->update(['status_id' => $new_status->id]);
        }
        Schema::table('market_orders', function(Blueprint $table) use($new_status) {
            DB::statement("ALTER TABLE `market_orders` CHANGE `status_id` `status_id` INT(10) UNSIGNED NULL DEFAULT '".$new_status->id."';");            
        });
        Schema::table('market_orders_statuses', function(Blueprint $table) {
            $table->string('color', 7)->default("#999999");
        });

        $statuses = DB::table('market_orders_statuses')->get();
        foreach ($statuses as $status) {
            switch ($status->alias) {
                case 'new':
                    DB::table('market_orders_statuses')->where('id', $status->id)->update(['color' => "#66CC66"]);
                    break;
                case 'in_work':
                    DB::table('market_orders_statuses')->where('id', $status->id)->update(['color' => "#3399CC"]);
                    break;
                case 'completed':
                    DB::table('market_orders_statuses')->where('id', $status->id)->update(['color' => "#999999"]);
                    break;
                case 'canceled':
                    DB::table('market_orders_statuses')->where('id', $status->id)->update(['color' => "#FF6666"]);
                    break;
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('market_orders_statuses', function (Blueprint $table) {
            $table->dropColumn('color');
        }); 
    }
}






