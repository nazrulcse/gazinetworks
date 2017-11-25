<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('phone');
            $table->string('work_zone');
            $table->string('nid');
            $table->text('address');
            $table->text('monthly_salary');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('phone');
            $table->dropColumn('work_zone');
            $table->dropColumn('nid');
            $table->dropColumn('address');
            $table->dropColumn('monthly_salary');
            $table->dropColumn('image');
        });
    }
}
