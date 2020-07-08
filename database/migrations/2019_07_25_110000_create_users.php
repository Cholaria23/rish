<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
    	Schema::dropIfExists('users');

        DB::table('sections')->insert([
            [
                'alias' => 'users',
                'lang_name' => 'AdminPanel::main.sections.users',
                'route' => 'admin.users.index',
            ]
        ]);

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name', 255)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('father_name', 255)->nullable();
            $table->string('img', 255)->nullable();
            $table->string('lang', 2)->nullable();
            $table->boolean('is_primary')->default(0);
            $table->string('gender', 1)->nullable();
            $table->string('login', 255)->unique();
            $table->string('password', 255)->nullable();
            $table->string('soc_uid', 255)->nullable();
            $table->string('soc_prov', 255)->nullable();
            $table->string('hash', 255)->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->string('phone_1', 255)->nullable();
            $table->string('phone_2', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('note')->nullable();
            $table->datetime('birthdate')->nullable();
            $table->string('country', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('building', 255)->nullable();
            $table->string('room', 255)->nullable();
            $table->string('card', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'users')->delete();
        Schema::drop('users');
    }
}
