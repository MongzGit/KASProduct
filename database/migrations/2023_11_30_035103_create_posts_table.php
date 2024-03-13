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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->unsignedBigInteger('user_id');
            $table->string('consumable_prod_name');
            $table->string('business_type')->default('');
            $table->string('consumable_prod_desc')->default('');
            $table->unsignedDouble('consumable_prod_price')->default(0.0);
            $table->string('consumable_prod_photo')->default('');
            $table->string('consumable_prod_location')->default('');
            $table->string('news_paper_name')->default('');
            $table->string('news_title')->default('');
            $table->string('news_headline')->default('');
            $table->string('news_byline')->default('');
            $table->string('news_lead_paragraph')->default('');
            $table->string('news_explanation_paragraph')->default('');
            $table->string('news_additional_explanation')->default('');
            $table->string('news_photo1')->default('');
            $table->string('news_photo2')->default('');
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
        Schema::dropIfExists('posts');
    }
};
