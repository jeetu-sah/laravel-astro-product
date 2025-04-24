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
        Schema::create('astro_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->string('product_name');
            $table->string('slug_name');
            $table->string('product_code', 20)->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('selling_price', 8, 2)->default(0);
            $table->smallInteger('quantity')->default(0);
            $table->smallInteger('alert_quantity')->default(0);

            $table->string('availibility', 10);
            $table->string('product_status', 10);
            $table->string('product_type', 20);
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('seo_keyword')->nullable();
            $table->text('meta_keyword')->nullable();

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
