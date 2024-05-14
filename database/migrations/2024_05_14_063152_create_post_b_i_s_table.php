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
            $table->string('consumable_prod_name')->default('')->nullable();
            $table->string('business_type')->default('')->nullable();
            $table->string('consumable_prod_desc')->default('')->nullable();
            $table->unsignedDouble('consumable_prod_price')->default(0.0)->nullable();
            $table->string('consumable_prod_photo')->default('')->nullable();
            $table->string('consumable_prod_location')->default('')->nullable();
            $table->string('news_paper_name')->default('')->nullable();
            $table->string('news_title')->default('')->nullable();
            $table->string('news_headline')->default('')->nullable();
            $table->string('news_byline')->default('')->nullable();
            $table->string('news_lead_paragraph')->default('')->nullable();
            $table->string('news_explanation_paragraph')->default('')->nullable();
            $table->string('news_additional_explanation')->default('')->nullable();
            $table->string('news_photo1')->default('')->nullable();
            $table->string('news_photo2')->default('')->nullable();
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
