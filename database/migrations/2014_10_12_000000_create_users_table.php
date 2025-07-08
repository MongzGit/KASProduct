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
            $table->string('name')->default('')->nullable();
            $table->string('lastname')->default('')->nullable();
            $table->string('photo')->default('')->nullable();
            $table->unsignedDouble('photo_width')->default(0.0)->nullable();
            $table->unsignedDouble('photo_height')->default(0.0)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('address_house_number')->default('')->nullable();
            $table->string('address_street_name')->default('')->nullable();
            $table->string('address_zone')->default('')->nullable();
            $table->string('address_location')->default('')->nullable();
            $table->string('address_city')->default('')->nullable();
            $table->string('address_postal_code')->default('')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('')->nullable();
            $table->string('phone_number')->default('')->nullable();
            $table->string('whatsapp_url')->default('')->nullable();
            $table->string('whatsapp_enabled')->default('')->nullable();//a-true, b or null - false, else - false
            $table->boolean('business_registered')->default(false);
            $table->string('business_name')->default('')->nullable();
            $table->string('business_desc')->default('')->nullable();
            $table->string('business_slogan')->default('')->nullable();
            $table->string('business_password')->default('')->nullable();
            $table->string('business_photo')->default('')->nullable();
            $table->unsignedDouble('business_photo_width')->default(0.0)->nullable();
            $table->unsignedDouble('business_photo_height')->default(0.0)->nullable();
            $table->string('business_email')->unique()->nullable();
            $table->timestamp('business_email_verified_at')->nullable();
            $table->string('business_address_house_number')->default('')->nullable();
            $table->string('business_address_street_name')->default('')->nullable();
            $table->string('business_address_zone')->default('')->nullable();
            $table->string('business_address_location')->default('')->nullable();
            $table->string('business_address_city')->default('')->nullable();
            $table->string('business_address_postal_code')->default('')->nullable();
            $table->string('business_phone_number')->default('')->nullable();
            $table->String('business_type')->default('')->nullable();
            $table->String('business_delivery_infor1')->default('')->nullable();//ETD business specific(PT1H30M), this diffines the time difference from when order is made
            $table->String('business_delivery_infor2')->default('')->nullable();// any information about delivery
            $table->unsignedDouble('business_delivery_std_cost')->default(0.0)->nullable();
            $table->String('business_general_infor')->default('')->nullable();
            $table->String('business_status')->default('')->nullable();//a- open, b-closed, c- Always open, d-lunch, e-sold out
            $table->String('business_opening_operating_hours')->default('')->nullable();//null or empty is auto (saved used HH:mm formate)
            $table->String('business_closing_operating_hours')->default('')->nullable();//null or empty is auto indefinately (saved used HH:mm formate)
            $table->String('business_allow_auto_operating_hours')->default('')->nullable();//a- allow auto, b-manual
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
