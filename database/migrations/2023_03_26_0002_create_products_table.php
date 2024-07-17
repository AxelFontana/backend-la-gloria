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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('size', 20);
            $table->string('image');
            $table->unsignedInteger('price');
            $table->boolean('enable')->default(true);
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();

            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')
                ->onDelete('cascade');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
