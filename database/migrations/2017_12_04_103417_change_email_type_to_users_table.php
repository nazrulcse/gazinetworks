<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEmailTypeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table -> string('work_zone')->nullable(true)->change();
            $table -> string('nid')->nullable(true)->change();
            $table -> string('address')->nullable(true)->change();
            $table -> string('monthly_salary')->nullable(true)->change();
            $table -> string('monthly_salary')->nullable(true)->change();
            $table->string('customer_road')->nullable(true)->change();
            $table->string('customer_house')->nullable(true)->change();
            $table->string('customer_flat')->nullable(true)->change();
            $table->integer('customer_tv_count')->nullable(true)->change();
            $table->integer('customer_monthly_bill')->nullable(true)->change();
            $table->integer('customer_discount')->nullable(true)->change();
            $table->integer('customer_connection_charge')->nullable(true)->change();
            $table->boolean('customer_is_free')->nullable(true)->change();
            $table->boolean('customer_set_top_box_iv')->nullable(true)->change();
            $table->boolean('customer_status')->nullable(true)->change();
            $table->string('customer_mobile_no')->nullable(true)->change();
            $table->string('customer_phone_no')->nullable(true)->change();
            $table->string('customer_zone')->nullable(true)->change();
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
