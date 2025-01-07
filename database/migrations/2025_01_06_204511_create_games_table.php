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
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->string('home_team_name')->default('')->nullable();
            $table->string('away_team_name')->default('')->nullable();
            $table->unsignedInteger('home_team_score')->default(0)->nullable();
            $table->unsignedInteger('away_team_score')->default(0)->nullable();
            $table->string('game_results')->default('c')->nullable();//a-home team win, b- away team win, c/null- drawn
            $table->string('game_status')->default('')->nullable();//a- not_played, b-in progress, c-played, d-forfieted
            $table->string('game_date')->default('')->nullable();
            $table->string('game_time')->default('')->nullable();
            $table->string('game_location')->default('')->nullable();
            $table->string('game_info')->default('')->nullable();
            $table->string('game_info2')->default('')->nullable();

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
        Schema::dropIfExists('games');
    }
};
