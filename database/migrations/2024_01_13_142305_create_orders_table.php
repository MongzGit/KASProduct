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
            $table->string('order_status')->default('')->nullable();
            $table->string('order_estimated_time_of_preparation')->default('')->nullable();
            $table->string('order_estimated_time_of_delivery')->default('')->nullable();
            // $table->string('order_post_consumable_business_name')->default('')->nullable();
            // $table->string('order_post_consumable_prod_name')->default('')->nullable();
            // $table->string('order_post_consumable_prod_desc')->default('')->nullable();
            // $table->string('order_post_consumable_prod_special')->default('')->nullable();
            // $table->string('order_post_consumable_prod_status')->default('')->nullable();
            // $table->string('order_post_consumable_prod_item_desc')->default('')->nullable();
            // $table->unsignedDouble('order_post_consumable_prod_price')->default(0.0)->nullable();
            // $table->string('order_post_post_general_infor1')->default('')->nullable();
            // $table->string('order_post_post_general_infor2')->default('')->nullable();
            // $table->unsignedDouble('order_post_post_general_infor3')->default(0.0)->nullable();
            // $table->string('order_post_post_general_infor4')->default('')->nullable();
            // $table->string('order_post_post_photo1')->default('')->nullable();
            // $table->unsignedDouble('order_post_post_photo1_width')->default(0.0)->nullable();
            // $table->unsignedDouble('order_post_post_photo1_height')->default(0.0)->nullable();
            // $table->string('order_post_post_photo2')->default('')->nullable();
            // $table->unsignedDouble('order_post_post_photo2_width')->default(0.0)->nullable();
            // $table->unsignedDouble('order_post_post_photo2_height')->default(0.0)->nullable();
            // $table->integer('order_post_relation_counter')->default(0)->nullable();

            // $table->string('poster_business_name')->default('')->nullable();
            // $table->string('poster_business_desc')->default('')->nullable();
            // $table->string('poster_business_photo')->default('')->nullable();
            // $table->unsignedDouble('poster_business_photo_width')->default(0.0)->nullable();
            // $table->unsignedDouble('poster_business_photo_height')->default(0.0)->nullable();
            // $table->string('poster_business_email')->unique()->nullable();
            // $table->string('poster_business_address_house_number')->default('')->nullable();
            // $table->string('poster_business_address_street_name')->default('')->nullable();
            // $table->string('poster_business_address_zone')->default('')->nullable();
            // $table->string('poster_business_address_location')->default('')->nullable();
            // $table->string('poster_business_address_city')->default('')->nullable();
            // $table->string('poster_business_address_postal_code')->default('')->nullable();
            // $table->string('poster_business_phone_number')->default('')->nullable();
            // $table->String('poster_business_type')->default('')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
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
