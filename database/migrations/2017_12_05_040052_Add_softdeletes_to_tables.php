<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftdeletesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->softDeletes();
        });

        Schema::table('invoices', function ($table) {
            $table->softDeletes();
        });

        Schema::table('payments', function ($table) {
            $table->softDeletes();
        });

        Schema::table('complains', function ($table) {
            $table->softDeletes();
        });

        Schema::table('contacts', function ($table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
