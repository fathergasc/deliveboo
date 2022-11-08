<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuisineRestaurantTable extends Migration
{
    
    public function up()
    {
        Schema::create('cuisine_restaurant', function (Blueprint $table) {
            $table->unsignedBigInteger('cuisine_id');
            $table->foreign('cuisine_id')->references('id')->on('cuisines');

            $table->unsignedBigInteger('restaurant_id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants');

            //to make it selectable in phpMyAdmin
            $table->primary(['cuisine_id', 'restaurant_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuisine_restaurant');
    }
}
