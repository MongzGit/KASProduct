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
        Schema::create('like_b_i_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_b_i_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->foreign('post_b_i_id')->references('id')
            ->on('post_b_i_s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_b_i_s');
    }
};
