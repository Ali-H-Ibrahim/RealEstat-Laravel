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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('town_id')->constrained('towns')->cascadeOnDelete();
            $table->string('type');
            $table->boolean('for_sell')->default(0);
            $table->boolean('for_rent')->default(0);
            $table->integer('duration_of_rent')->nullable();
            $table->double('price');
            $table->string('main_image');
            $table->string('secondary_image');
            $table->double('area');
            $table->integer('number_of_rooms');
            $table->integer('number_of_bathrooms');
            //ddddddddddddd
            $table->boolean('phone_subscription');
            $table->boolean('net_subscription');
            $table->double('dimension_of_the_city');
            $table->double('dimension_of_the_school');
            $table->double('dimension_of_the_market');
            $table->text('owner_description')->nullable();
            $table->boolean('sold_rented')->default(0);;
            $table->double('offer')->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->enum('status',['On','Off'])->default('off');
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
        Schema::dropIfExists('properties');
    }
};
