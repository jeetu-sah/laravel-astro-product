<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->string('product_code', 20)->nullable();
            $table->decimal('basic_price', 8, 2)->default(0);
            $table->string('product_type', 20);
            $table->string('product_status', 10)->default('draft');

            $table->foreignIdFor(User::class)->nullable();

            $table->timestamps();
            $table->softDeletes('deleted_at', precision: 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astro_products');
    }
};
