<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('GoogleProvider_id')->nullable();
            $table->string('FacebookProvider_id')->nullable();
        });

        $users = \Demos\AdminPanel\User::get();

        foreach ($users as $user) {
            if ($user->provider == "GoogleProvider") {
                $user->GoogleProvider_id = $user->provider_user_id;
                $user->save();
            }
            if ($user->provider == "FacebookProvider") {
                $user->FacebookProvider_id = $user->provider_user_id;
                $user->save();
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('provider_user_id');
            $table->dropColumn('provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider_user_id')->nullable();
            $table->string('provider')->nullable();
        });

        $users = \Demos\AdminPanel\User::get();

        foreach ($users as $user) {
            if ($user->GoogleProvider_id != "") {
                $user->provider = "GoogleProvider";
                $user->provider_user_id = $user->GoogleProvider_id;
                $user->save();
            }
            if ($user->FacebookProvider_id != "") {
                $user->provider = "FacebookProvider";
                $user->provider_user_id = $user->FacebookProvider_id;
                $user->save();
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('GoogleProvider_id');
            $table->dropColumn('FacebookProvider_id');
        });
    }
}
