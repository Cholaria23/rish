<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccountsLinks extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('accounts_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('sort_order')->default(0);
            $table->string('href', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->foreign('account_id', 'accounts_links_1')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE'); 
        });
    }

    public function down() {
        Schema::dropIfExists('accounts_links');
    }
}