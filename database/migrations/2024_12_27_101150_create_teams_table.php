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
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_b_i_id');
            $table->string('team_name')->default('')->nullable();
            $table->string('team_aka_name')->default('')->nullable();
            $table->string('team_desc')->default('')->nullable();
            $table->string('team_info')->default('')->nullable();
            $table->string('team_info2')->default('')->nullable();
            $table->string('matches_played')->default('')->nullable();
            $table->string('matches_won')->default('')->nullable();
            $table->string('matches_drawn')->default('')->nullable();
            $table->string('matches_lost')->default('')->nullable();
            $table->string('points')->default('')->nullable();
            $table->string('goals')->default('')->nullable();
            $table->string('current_news')->default('')->nullable();
            $table->string('post_photo1')->default('')->nullable();
            $table->unsignedDouble('post_photo1_width')->default(0.0)->nullable();
            $table->unsignedDouble('post_photo1_height')->default(0.0)->nullable();
            $table->string('post_photo2')->default('')->nullable();
            $table->unsignedDouble('post_photo2_width')->default(0.0)->nullable();
            $table->unsignedDouble('post_photo2_height')->default(0.0)->nullable();
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
        Schema::dropIfExists('teams');
    }
};
