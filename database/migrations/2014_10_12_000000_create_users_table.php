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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('');
            $table->string('lastname')->default('');
            $table->string('photo')->default('');
            $table->unsignedDouble('photo_width')->default(0.0)->nullable();
            $table->unsignedDouble('photo_height')->default(0.0)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('address')->default('');
            $table->string('location')->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('');
            $table->string('phone_number')->default('');
            $table->boolean('business_registered')->default(false);
            $table->string('business_name')->default('');
            $table->string('business_desc')->default('');
            $table->string('business_password')->default('');
            $table->string('business_photo')->default('');
            $table->unsignedDouble('business_photo_width')->default(0.0)->nullable();
            $table->unsignedDouble('business_photo_height')->default(0.0)->nullable();
            $table->string('business_email')->unique()->nullable();
            $table->timestamp('business_email_verified_at')->nullable();
            $table->string('business_address')->default('');
            $table->string('business_location')->default('');
            $table->string('business_phone_number')->default('');
            $table->String('business_type')->default('');
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
        Schema::dropIfExists('users');
    }
};
