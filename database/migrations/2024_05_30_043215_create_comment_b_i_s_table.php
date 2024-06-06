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
        Schema::create('comment_b_i_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_b_i_id');
            //$table->unsignedBigInteger('order_id');
            $table->string('commentBI');
            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->foreign('post_b_i_id')->references('id')
            ->on('post_b_i_s')->onDelete('cascade');

           // $table->foreign('order_id')->references('id')
           // ->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_b_i_s');
    }
};
