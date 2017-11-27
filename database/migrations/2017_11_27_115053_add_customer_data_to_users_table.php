<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('customer_id');
            $table->string('customer_road');
            $table->string('customer_house');
            $table->string('customer_flat');
            $table->integer('customer_tv_count');
            $table->integer('customer_monthly_bill');
            $table->integer('customer_discount');
            $table->integer('customer_connection_charge');
            $table->boolean('customer_is_free');
            $table->boolean('customer_set_top_box_iv');
            $table->boolean('customer_status');
            $table->string('customer_mobile_no');
            $table->string('customer_phone_no');
            $table->string('customer_zone');
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
