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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


                 
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');

            $table->unsignedBigInteger('image_id');
            $table->foreign('image_id')->references('id')->on('image_galleries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
