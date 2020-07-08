<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCatExport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units_users_params', function(Blueprint $table) {
            $table->text('export_cats_template')->nullable();
            $table->text('import_cats_template')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units_users_params', function (Blueprint $table) {
            $table->dropColumn('export_cats_template', 'import_cats_template');
        });  
    }
}
