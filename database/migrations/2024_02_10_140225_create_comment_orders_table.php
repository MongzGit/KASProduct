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
        Schema::create('comment_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');

            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('post_user_id');
            $table->string('comment_infor1')->default('')->nullable();
            $table->string('comment_infor2')->default('')->nullable();
            $table->string('commentOrder_post_post_type')->default('')->nullable();
            $table->string('commentOrder_post_consumable_business_name')->default('')->nullable();
            $table->string('commentOrder_post_consumable_prod_name')->default('')->nullable();
            $table->string('commentOrder_post_consumable_prod_desc')->default('')->nullable();
            $table->string('commentOrder_post_consumable_prod_special')->default('')->nullable();
            $table->string('commentOrder_post_consumable_prod_status')->default('')->nullable();
            $table->string('commentOrder_post_consumable_prod_item_desc')->default('')->nullable();
            $table->unsignedDouble('commentOrder_post_consumable_prod_price')->default(0.0)->nullable();
            $table->unsignedInteger('commentOrder_post_consumable_prod_quantity')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->foreign('order_id')->references('id')
            ->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_orders');
    }
};
