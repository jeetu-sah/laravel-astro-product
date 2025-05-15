<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->char('status', 15)->default('pending')->comment('pending', 'completed', 'canceled', 'refunded');
            $table->char('payment_status', 15)->default('unpaid')->comment('paid', 'unpaid', 'partial');

            $table->text('shipping_address');
            $table->text('billing_address')->nullable();

            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('astro_products')->onDelete('cascade');



            $table->string('product_name');
            $table->string('product_sku');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
    }
};
