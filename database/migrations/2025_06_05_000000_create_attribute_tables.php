<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        // Attributes table
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('type', 10); // text, dropdown, boolean, etc.
            $table->boolean('is_filterable')->default(false);
            $table->boolean('is_required')->default(false);
            $table->boolean('is_variation')->default(false);
            $table->string('status', 10)->default('active');
            $table->timestamps();
        });

        // Attribute Translations table (optional)
        Schema::create('attribute_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->string('locale', 10)->index();
            $table->string('name', 30);
            $table->string('slug_name', 30);
            $table->text('description')->nullable();
            $table->unique(['attribute_id', 'locale']);
        });

        // Attribute Values table
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->string('value', 20);
            $table->integer('sort_order')->nullable();
            $table->string('slug', 20)->nullable();
            $table->timestamps();
        });

        // Attribute Value Translations (optional)
        Schema::create('attribute_value_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_value_id')->constrained()->onDelete('cascade');
            $table->string('locale', 10)->index();
            $table->string('name', 20);
            $table->unique(['attribute_value_id', 'locale']);
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('attribute_value_translations');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attribute_translations');
        Schema::dropIfExists('attributes');
    }
};
