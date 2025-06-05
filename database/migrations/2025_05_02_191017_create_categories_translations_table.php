<?php

use App\Models\Category;
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
        Schema::create('categories_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')
            //     ->onDelete('cascade');
            $table->foreignIdFor(Category::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');



            $table->string('locale')->index();

            $table->string('name')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();

            $table->unique(['category_id', 'locale']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_translations');
    }
};
