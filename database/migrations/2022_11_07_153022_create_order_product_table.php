<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{

    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            //to make it selectable in phpMyAdmin
            $table->primary(['order_id', 'product_id']);

            $table->unsignedTinyInteger('quantity')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
