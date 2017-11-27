<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->string('customer_id')->unique();
            $table->text('address');
            $table->string('road');
            $table->string('house');
            $table->string('flat');
            $table->integer('tv_count');
            $table->integer('monthly_bill');
            $table->integer('discount');
            $table->integer('connection_charge');
            $table->boolean('is_free');
            $table->boolean('set_top_box_iv');
            $table->string('status');
            $table->string('mobile_no');
            $table->string('phone_no');
            $table->string('zone');
            $table->string('password');
            $table->string('reset_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
