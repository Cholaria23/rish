<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeads extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        DB::table('sections')->insert([
            [
                'alias' => 'leads',
                'lang_name' => 'AdminPanel::main.sections.leads',
                'route' => 'admin.leads.index',
            ]
        ]);

        Schema::create('leads_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('color', 255)->nullable()->default("#999999");
        });

        DB::table('leads_statuses')->insert([
            [
                'name' => 'Новый',
                'color' => '#66CC66',
            ],
            [
                'name' => 'Просмотренный',
                'color' => '#3399CC',
            ],
            [
                'name' => 'Отмененный',
                'color' => '#999999',
            ],
        ]);

        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_type_id')->unsigned()->index();
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->boolean('is_hidden')->default(1);
            $table->integer('unit_id')->unsigned()->index()->nullable();
            $table->integer('cat_id')->unsigned()->index()->nullable();
            $table->integer('status_id')->unsigned()->index()->default(1);
            $table->text('content')->nullable();
            $table->string('page_url', 255)->nullable();
            $table->string('page_title', 255)->nullable();
            $table->string('user_last_name', 255)->nullable();
            $table->string('user_first_name', 255)->nullable();
            $table->string('user_father_name', 255)->nullable();
            $table->string('user_email', 255)->nullable();
            $table->string('user_phone', 255)->nullable();
            $table->string('user_ip', 255)->nullable();
            $table->string('audio', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('file', 255)->nullable();
            $table->integer('rating')->default(0);
            $table->text('plus')->nullable();
            $table->text('minus')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });        

        Schema::table('leads', function(Blueprint $table) {
            $table->foreign('form_type_id', 'leads_1')->references('id')->on('form_types')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('parent_id', 'leads_2')->references('id')->on('leads')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('unit_id', 'leads_3')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('cat_id', 'leads_4')->references('id')->on('units_categories')->onUpdate('CASCADE')->onDelete('CASCADE'); 
            $table->foreign('status_id', 'leads_5')->references('id')->on('leads_statuses'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        DB::table('sections')->where('alias', 'leads')->delete();

        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign('leads_1');
            $table->dropForeign('leads_2');
            $table->dropForeign('leads_3');
            $table->dropForeign('leads_4');
            $table->dropForeign('leads_5');
        });        
        Schema::dropIfExists('leads');
        Schema::dropIfExists('leads_statuses');
    }
}
