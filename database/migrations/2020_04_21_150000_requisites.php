<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Requisites extends Migration
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
                'alias' => 'requisites',
                'lang_name' => 'AdminPanel::main.sections.requisites',
                'route' => 'admin.requisites',
            ],
        ]);

        Schema::create('requisites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->string('phone_1', 255)->nullable();
            $table->string('phone_2', 255)->nullable();
            $table->string('phone_3', 255)->nullable();
            $table->string('logo', 255)->nullable();
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('sections')->where('alias', 'requisites')->delete();
        Schema::dropIfExists('requisites');
    }
}