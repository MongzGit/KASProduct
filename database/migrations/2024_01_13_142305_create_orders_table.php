<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_post_user_id');
            $table->string('order_number')->default('')->nullable();
            $table->string('order_type')->default('')->nullable();
            $table->string('order_post_user_business_name')->default('')->nullable();
            $table->string('order_post_user_business_desc')->default('')->nullable();
            $table->string('order_post_user_business_email')->default('')->nullable();
            $table->string('order_post_user_business_address_house_number')->default('')->nullable();
            $table->string('order_post_user_business_address_street_name')->default('')->nullable();
            $table->string('order_post_user_business_address_zone')->default('')->nullable();
            $table->string('order_post_user_business_address_location')->default('')->nullable();
            $table->string('order_post_user_business_address_city')->default('')->nullable();
            $table->string('order_post_user_business_phone_number')->default('')->nullable();
            $table->string('order_status')->default('')->nullable();
            $table->string('order_total_cost')->default('')->nullable();
            $table->string('order_payment_type')->default('')->nullable();//cash payment/EFT payment
            $table->String('order_delivery_infor1')->default('')->nullable();//ETD
            $table->String('order_delivery_infor2')->default('')->nullable();
            $table->unsignedDouble('order_delivery_std_cost')->default(0.0)->nullable();
            $table->string('order_estimated_time_of_preparation')->default('')->nullable();
            $table->string('order_estimated_time_of_delivery')->default('')->nullable();

            $table->timestamps();

            // $table->foreign('user_id')->references('id')
            // ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
