<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitTimetable extends Migration
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
                'alias' => 'timetable',
                'lang_name' => 'AdminPanel::main.sections.timetable',
                'route' => 'admin.timetable.index',
            ]
        ]); 
        $parent_id = DB::table('sections')->where('alias', 'timetable')->first()->id;

        DB::table('sections')->insert([
            [
                'alias' => 'edit_timetable',
                'lang_name' => 'AdminPanel::main.sections.edit_timetable',
                'route' => 'admin.timetable.editTimetable',
                'parent_id' => $parent_id,
            ],
        ]);

        DB::table('sections')->insert([
            [
                'alias' => 'timetable_params',
                'lang_name' => 'AdminPanel::main.sections.timetable_params',
                'route' => 'admin.timetable.params',
                'parent_id' => $parent_id,
            ],
        ]);

        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('timetables')->insert([
            'alias' => 'default'
        ]);

        Schema::create('timetables_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timetable_id')->unsigned()->index()->nullable();
            $table->string('lang', 255)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();       
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_key', 255)->nullable();
            $table->text('meta_desc')->nullable();
        });

        Schema::table('timetables_lang', function(Blueprint $table) {
            $table->foreign('timetable_id', 'timetables_lang_1')->references('id')->on('timetables')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('timetables_lang')->insert([
            [
                'timetable_id' => 1,
                'lang' => 'ru',
                'name' => 'Расписание',
                'description' => NULL,
            ]
        ]);

        Schema::create('timetables_days', function($table){
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->boolean('is_hidden')->default(0);
            $table->string('alias')->nullable();
        });

        DB::table('timetables_days')->insert([
            ['alias' => 'monday'],
            ['alias' => 'tuesday'],
            ['alias' => 'wednesday'],
            ['alias' => 'thursday'],
            ['alias' => 'friday'],
            ['alias' => 'saturday'],
            ['alias' => 'sunday']
        ]);

        Schema::create('timetables_days_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id')->unsigned()->index()->nullable();
            $table->string('lang', 255)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('short_name', 255)->nullable();
        });

        Schema::table('timetables_days_lang', function(Blueprint $table) {
            $table->foreign('day_id', 'timetables_days_lang_1')->references('id')->on('timetables_days')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('timetables_days_lang')->insert([
            ['day_id' => 1, 'short_name' => 'ПН', 'name' => 'Понедельник'],
            ['day_id' => 2, 'short_name' => 'ВТ', 'name' => 'Вторник'],
            ['day_id' => 3, 'short_name' => 'СР', 'name' => 'Среда'],
            ['day_id' => 4, 'short_name' => 'ЧТ', 'name' => 'Четверг'],
            ['day_id' => 5, 'short_name' => 'ПТ', 'name' => 'Пятница'],
            ['day_id' => 6, 'short_name' => 'СБ', 'name' => 'Суббота'],
            ['day_id' => 7, 'short_name' => 'ВС', 'name' => 'Воскресенье']
        ]);

        Schema::create('timetables_params', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timetable_id')->unsigned()->index()->nullable();
            $table->text('services_cats')->nullable();
            $table->text('places_cats')->nullable();
            $table->text('persons_cats')->nullable();
        });

        Schema::table('timetables_params', function(Blueprint $table) {
            $table->foreign('timetable_id', 'timetables_params_1')->references('id')->on('timetables')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('timetables_params')->insert([
            'timetable_id'  => 1
        ]);

        Schema::create('timetables_markers', function($table){
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('alias', 255)->nullable();
            $table->text('svg')->nullable();
            $table->string('icon', 255)->nullable();
        });

        DB::table('timetables_markers')->insert([
            ['alias' => 'default'],
            ['alias' => 'new'],
            ['alias' => 'top'],
        ]);

        Schema::create('timetables_markers_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('marker_id')->unsigned()->index()->nullable();
            $table->string('lang', 255)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('description', 255)->nullable();
        });

        Schema::table('timetables_markers_lang', function(Blueprint $table) {
            $table->foreign('marker_id', 'timetables_markers_lang_1')->references('id')->on('timetables_markers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::table('timetables_markers_lang')->insert([
            ['marker_id' => 1, 'name' => 'Обычный'],
            ['marker_id' => 2, 'name' => 'Новинка'],
            ['marker_id' => 3, 'name' => 'Топ'],
        ]);

        Schema::create('timetables_events', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_hidden')->default(1);
            $table->integer('timetable_id')->unsigned()->index()->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('timetables_events_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->index()->nullable();
            $table->string('lang', 255)->default('ru');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();       
        });
        Schema::table('timetables_events_lang', function(Blueprint $table) {
            $table->foreign('event_id', 'timetables_events_lang_1')->references('id')->on('timetables_events')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('timetables_events_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->index()->nullable();     
            $table->integer('day_id')->unsigned()->index()->nullable();
        });

        Schema::table('timetables_events_days', function (Blueprint $table) {
            $table->foreign('event_id', 'timetables_events_days_1')->references('id')->on('timetables_events')->onUpdate('CASCADE')->onDelete('CASCADE');   
            $table->foreign('day_id', 'timetables_events_days_2')->references('id')->on('timetables_days')->onUpdate('CASCADE')->onDelete('CASCADE');   
        });

        Schema::create('timetables_events_markers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->index()->nullable();     
            $table->integer('marker_id')->unsigned()->index()->nullable();
        });
        Schema::table('timetables_events_markers', function (Blueprint $table) {
            $table->foreign('event_id', 'timetables_events_markers_1')->references('id')->on('timetables_events')->onUpdate('CASCADE')->onDelete('CASCADE');   
            $table->foreign('marker_id', 'timetables_events_markers_2')->references('id')->on('timetables_markers')->onUpdate('CASCADE')->onDelete('CASCADE');   
        });

        Schema::create('timetables_events_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->index()->nullable();     
            $table->integer('unit_id')->unsigned()->index()->nullable();
        });
        Schema::table('timetables_events_units', function (Blueprint $table) {
            $table->foreign('event_id', 'timetables_events_units_1')->references('id')->on('timetables_events')->onUpdate('CASCADE')->onDelete('CASCADE');   
            $table->foreign('unit_id', 'timetables_events_units_2')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('rel_type', 255)->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('timetables_events_units');
        Schema::dropIfExists('timetables_events_markers');
        Schema::dropIfExists('timetables_events_days');
        Schema::dropIfExists('timetables_events_lang');
        Schema::dropIfExists('timetables_events');
        Schema::dropIfExists('timetables_markers_lang');
        Schema::dropIfExists('timetables_markers');
        Schema::dropIfExists('timetables_params');
        Schema::dropIfExists('timetables_days_lang');
        Schema::dropIfExists('timetables_days');
        Schema::dropIfExists('timetables_lang');
        Schema::dropIfExists('timetables');
        DB::table('sections')->where('alias', 'timetable')->delete();
    }
}
