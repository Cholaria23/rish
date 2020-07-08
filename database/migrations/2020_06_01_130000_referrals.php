<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Referrals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('sections')->insert([
            [
                'alias' => 'referrals',
                'lang_name' => 'AdminPanel::main.sections.referrals',
                'route' => 'admin.referrals',
            ],
        ]);

        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->boolean('is_use', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('referrals_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->boolean('is_use', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        $langs = DB::table('languages')->where('hidden_admin', 0)->get()->pluck('code')->toArray();

        $name = [];

        foreach ($langs as $lang) {
            if ($lang == 'ru') {
                $name[$lang] = 'Вход на страницу';
            } elseif ($lang == 'uk') {
                $name[$lang] = 'Вхід на сторінку';
            } elseif ($lang == 'en') {
                $name[$lang] = 'Page hit';
            } else {
                $name[$lang] = 'Visit';
            }
        }


        $name = json_encode($name);
        

        DB::table('referrals_events')->insert([
            ['name' => $name, 'is_use' => 1,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")]
        ]);

        Schema::create('referrals_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referral_id')->nullable()->index()->unsigned();
            $table->integer('event_id')->nullable()->index()->unsigned();
            $table->string('page_title', 255)->nullable();
            $table->string('page_url', 255)->nullable();
            $table->string('ip', 255)->nullable();
            $table->timestamps();
        });

        Schema::table('referrals_logs', function(Blueprint $table) {
            $table->foreign('referral_id', 'referrals_logs_referral_id')->references('id')->on('referrals')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('event_id', 'referrals_logs_event_id')->references('id')->on('referrals_events')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'referrals')->delete();
        Schema::dropIfExists('referrals_logs');
        Schema::dropIfExists('referrals_events');
        Schema::dropIfExists('referrals');
    }
}