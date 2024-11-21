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
        Schema::create('post_b_i_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); 
            $table->string('post_type')->default('')->nullable();
            $table->string('prod_business_name')->default('')->nullable();
            $table->string('prod_name')->default('')->nullable();
            $table->string('prod_desc', 1500)->default('')->nullable();
            $table->unsignedDouble('prod_price')->default(0.0)->nullable();
            $table->string('prod_status')->default('')->nullable();
            $table->string('consumable_prod_special')->default('')->nullable();
            $table->string('consumable_prod_item_desc')->default('')->nullable();
            $table->String('consumable_prod_delivery_infor1')->default('')->nullable();
            $table->String('consumable_prod_delivery_infor2')->default('')->nullable();
            $table->unsignedDouble('consumable_prod_delivery_std_cost')->default(0.0)->nullable();
            $table->string('consumable_prod_location')->default('')->nullable();
            $table->string('news_headline')->default('')->nullable();
            $table->string('news_byline')->default('')->nullable();
            $table->string('news_lead_paragraph', 1500)->default('')->nullable();
            $table->string('news_explanation_paragraph',1500)->default('')->nullable();
            $table->string('news_additional_explanation')->default('')->nullable();
            $table->string('taxi_main_rank_address')->default('')->nullable();
            $table->string('taxi_main_rank_status')->default('')->nullable();
            $table->string('taxi_standby_taxi')->default('')->nullable();
            $table->unsignedDouble('taxi_standby_taxi_seat_limit')->default(0.0)->nullable();
            $table->unsignedDouble('taxi_standby_taxi_seat_token')->default(0.0)->nullable();//passenger taken
            $table->unsignedDouble('taxi_standby_taxi_fee')->default(0.0)->nullable();
            $table->unsignedDouble('taxi_standby_taxi_etd')->default(0.0)->nullable();
            $table->unsignedDouble('taxi_standby_taxi_eta')->default(0.0)->nullable();
            $table->string('taxi_desination_stop_final')->default('')->nullable();
            $table->string('taxi_desination_stop1')->default('')->nullable();
            $table->string('event_desc')->default('')->nullable();
            $table->string('event_location')->default('')->nullable();
            $table->string('event_date')->default('')->nullable();
            $table->string('event_time')->default('')->nullable();
            $table->unsignedDouble('event_ticket_price_general')->default('')->nullable();
            $table->unsignedDouble('event_ticket_price_golden')->default('')->nullable();
            $table->unsignedDouble('event_ticket_price_vip')->default('')->nullable();
            $table->unsignedDouble('event_ticket_price_vvip')->default('')->nullable(); 
            $table->string('event_artist_lineup', 1500)->default('')->nullable();
            $table->string('event_specials')->default('')->nullable();
            $table->string('post_general_infor1')->default('')->nullable(); //used for sorting internally and grouping with item description.
            $table->string('post_general_infor2')->default('')->nullable();
            $table->unsignedDouble('post_general_infor3')->default(0.0)->nullable();
            $table->string('post_general_infor4')->default('')->nullable();
            $table->string('post_photo1')->default('')->nullable();
            $table->unsignedDouble('post_photo1_width')->default(0.0)->nullable();
            $table->unsignedDouble('post_photo1_height')->default(0.0)->nullable();
            $table->string('post_photo2')->default('')->nullable();
            $table->unsignedDouble('post_photo2_width')->default(0.0)->nullable();
            $table->unsignedDouble('post_photo2_height')->default(0.0)->nullable();
            $table->integer('relation_counter')->default(0)->nullable();
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
        Schema::dropIfExists('post_b_i_s');
    }
};
