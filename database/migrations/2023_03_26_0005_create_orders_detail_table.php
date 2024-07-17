<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_amount');
            $table->timestamps();


            $table->integer('shopping_cart_id')->unsigned();
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts')
                ->onDelete('cascade');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_detail');
    }
};
