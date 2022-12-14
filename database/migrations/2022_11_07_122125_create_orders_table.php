<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('phone', 25);
            $table->string('email', 100);
            $table->string('shipping_address', 255);
            $table->unsignedDecimal('total_price', 10, 2)->default(0);
            $table->boolean('paid')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
