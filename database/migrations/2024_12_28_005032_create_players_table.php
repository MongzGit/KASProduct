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
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('team_id');
            $table->string('name')->default('')->nullable();
            $table->string('lastname')->default('')->nullable();
            $table->string('age')->default('')->nullable();
            $table->string('height')->default('')->nullable();
            $table->string('weight')->default('')->nullable();
            $table->string('address')->default('')->nullable();
            $table->string('position')->default('')->nullable();
            $table->string('jersey_number')->default('')->nullable();
            $table->string('running_speed')->default('')->nullable();
            $table->string('goals')->default('')->nullable();
            $table->string('assists')->default('')->nullable();
            $table->string('matches_played')->default('')->nullable();
            $table->string('player_info')->default('')->nullable();
            $table->string('player_info2')->default('')->nullable();
            $table->string('post_photo1')->default('')->nullable();
            $table->unsignedDouble('post_photo1_width')->default(0.0)->nullable();
            $table->unsignedDouble('post_photo1_height')->default(0.0)->nullable();
            $table->string('post_photo2')->default('')->nullable();
            $table->unsignedDouble('post_photo2_width')->default(0.0)->nullable();
            $table->unsignedDouble('post_photo2_height')->default(0.0)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->foreign('team_id')->references('id')
            ->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};
