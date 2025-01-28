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
        Schema::create('components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_b_i_id');
            $table->string('component_name')->default('')->nullable();
            $table->string('component_code')->default('')->nullable();//to identify on the global 
            $table->string('component_desc')->default('')->nullable();
            $table->string('component_type')->default('a')->nullable();//a-general,b-optional,c-sauces,d-extras
            $table->string('component_info')->default('')->nullable();
            $table->unsignedDouble('price_per_component')->default(0.0)->nullable();
            $table->unsignedDouble('weight_per_component')->default(0.0)->nullable();
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
        Schema::dropIfExists('components');
    }
};
