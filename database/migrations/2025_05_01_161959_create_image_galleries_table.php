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
        Schema::create('image_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image_name')->nullable();
            $table->string('alt_name')->nullable();
            $table->tinyText('name');
            $table->tinyText('image_url');
            $table->string('image_size')->nullable();
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_galleries_products');
    }
};
